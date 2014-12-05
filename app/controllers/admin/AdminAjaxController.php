<?php


/**
 * Class AdminAjaxController
 * @property Elastic elastic
 */
class AdminAjaxController extends AdminController
{
    /**
     * @var Evercisegroup
     */
    private $evercisegroup;
    /**
     * @var \Illuminate\Http\Request
     */
    private $input;
    /**
     * @var \Illuminate\Log\Writer
     */
    private $log;
    /**
     * @var Es
     */
    private $elasticsearch;
    /**
     * @var Geotools
     */
    private $geotools;
    /**
     * @var
     */
    private $elastic;

    /**
     *
     */
    public function __construct(
        Evercisegroup $evercisegroup,
        Illuminate\Http\Request $input,
        Illuminate\Log\Writer $log,
        Es $elasticsearch,
        Geotools $geotools
    ) {

        parent::__construct();

        $this->evercisegroup = $evercisegroup;
        $this->input = $input;
        $this->log = $log;
        $this->elasticsearch = $elasticsearch;
        $this->geotools = $geotools;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchStats()
    {

        $this->elastic = new Elastic(
            Geotools::getFacadeRoot(),
            $this->evercisegroup,
            Es::getFacadeRoot(),
            $this->log
        );

        $response = ['draw' => $this->input->get('draw')];

        $search = $this->input->get('search');

        $from = $this->input->get('start', 0);
        $size = $this->input->get('lenght', 50);


        $results = $this->elastic->searchStats(['size' => $size, 'from' => $from, 'search' => $search['value']]);


        $response['recordsTotal'] = $results->total;
        $response['recordsFiltered'] = $results->total;

        foreach ($results->hits as $r) {

            $response['data'][] = [
                $r->_source->search,
                $r->_source->size,
                $r->_source->results,
                $r->_source->user_id,
                $r->_source->name,
                $r->_source->date
            ];

        }

        return Response::json($response);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword()
    {
        $user = Sentry::findUserById(Input::get('user_id'));

        $reset_code = $user->getResetPasswordCode();
        $user->sendForgotPasswordEmail($reset_code);

        return Response::json([
            'callback' => 'adminPopupMessage',
            'message'  => 'Password reset.  Email:' . $user->email
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckUrl()
    {

        $this->beforeFilter('csrf', ['on' => 'post']);

        $url = $this->request->get('url');

        /** CHeck if the URL is in the articles */
        $check = Articles::where('permalink', $url)->count();

        if ($check > 0) {
            return Response::json(['error' => TRUE]);
        }

        /** CHeck if the URL is in the ArticleCategories */
        $check = ArticleCategories::where('permalink', $url)->count();

        if ($check > 0) {
            return Response::json(['error' => TRUE]);
        }


        return Response::json(['error' => FALSE]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRating()
    {
        $result = FakeRating::validateAndCreateRating();

        if ($result['validation_failed']) {
            return Response::json($result);
        } else {
            return Response::json(['callback' => 'successAndRefresh']);
        }

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function editSubcategories()
    {
        $categoryChanges = Input::get('update_categories');
        $assNumbers = explode(',', Input::get('update_associations'));

        $associations = [];

        foreach ($assNumbers as $assId) {
            array_push($associations, [$assId => Input::get('associations_' . $assId)]);
        }


        Subcategory::editSubcategoryCategories($categoryChanges);
        Subcategory::editAssociations($associations);

        //return Response::json(['callback' => 'adminPopupMessage', 'message' => count($associations).' : '.Input::get('associations_'.'3')]);
        return Response::json(['callback' => 'successAndRefresh']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSubcategory()
    {
        $newCategoryName = Input::get('new_subcategory');

        Subcategory::create(['name' => $newCategoryName]);

        return Response::json(['callback' => 'successAndRefresh']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function unapproveTrainer()
    {
        $user = Sentry::findUserById(Input::get('user_id'));

        Trainer::unapprove($user);

        return Response::json(['callback' => 'successAndRefresh']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function editGroupSubcats()
    {
        $groupIds = explode(',', Input::get('update_categories'));

        $groupSubcats = [];

        foreach ($groupIds as $groupId) {
            array_push($groupSubcats, [$groupId => Input::get('categories_' . $groupId)]);
            if ($eg = Evercisegroup::find($groupId)) {
                $eg->adminMakeClassFeatured(Input::get('featured_' . $groupId));
            }
        }
        Evercisegroup::editSubcats($groupSubcats);


        return Response::json(['callback' => 'successAndRefresh']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveTags()
    {
        $tags = implode(',', Input::get('tags'));
        $id = Input::get('id');

        Gallery::where('id', $id)->update(['keywords' => $tags]);

        return Response::json(['saved' => TRUE]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGalleryImage()
    {
        $id = Input::get('id');

        $gallery = Gallery::find($id);

        @unlink('files/gallery_defaults/' . $gallery->image);


        return Response::json(['deleted' => $gallery->delete(), 'id' => $id]);
    }


    /**
     * @return bool|string
     */
    public function galleryUploadFile()
    {
        if ($file = Request::file('file')) {


            if (!is_dir('files/gallery_defaults')) {
                mkdir('files/gallery_defaults');
            }

            $name = $file->getClientOriginalName();
            /** Save the image name without the Prefix to the DB */

            $save = FALSE;
            foreach (Config::get('evercise.gallery.sizes') as $img) {

                $file_name = $img['prefix'] . '_' . $name;

                $image = Image::make($_FILES['file']['tmp_name'])->fit(
                    $img['width'],
                    $img['height']
                )->save(public_path() . '/files/gallery_defaults/' . $file_name);


                if ($image) {
                    $save = TRUE;
                }

            }

            if ($save) {
                Gallery::create(['image' => $name, 'counter' => Config::get('evercise.gallery.image_counter', 3)]);

                return '/files/gallery_defaults/thumb_' . $name;
            }
        }

        return FALSE;


    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function featureClass()
    {
        $id = $this->input->get('id');

        $class = $this->evercisegroup->find($id);


        if ($class->isFeatured()) {
            FeaturedClasses::where('evercisegroup_id', $id)->delete();

            event('class.index.single', [$id]);
            return Response::json(['featured' => FALSE]);
        }


        FeaturedClasses::create(['evercisegroup_id' => $id]);

        event('class.index.single', [$id]);

        return Response::json(['featured' => TRUE]);

    }

    /**
     *
     */
    public function sliderStatus()
    {
        $id = Input::get('id');
        $checked = Input::get('checked');

        $slider = Slider::where(['evercisegroup_id' => $id])->first();
        $slider->active = (int)$checked;
        $slider->save();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sliderUpload()
    {

        $class = Evercisegroup::find(Input::get('id'));
        if ($file = Request::file('file')) {


            if (!is_dir('files/slider')) {
                mkdir('files/slider');
            }
            $image = Image::make($_FILES['file']['tmp_name']);
            $ext = $file->getClientOriginalExtension();
            $name = slugIt([$class->id, $class->name]) . '.' . $ext;
            /** Save the image name without the Prefix to the DB */

            $save = FALSE;
            foreach (Config::get('evercise.slider_images') as $img) {

                $file_name = $img['prefix'] . '_' . $name;

                $image = $image->fit(
                    $img['width'],
                    $img['height']
                )->save(public_path() . '/files/slider/' . $file_name);


                if ($image) {
                    $save = TRUE;
                }

            }

            if ($save) {

                $slide = Slider::firstOrNew(['evercisegroup_id' => $class->id]);
                $slide->image = $name;
                $slide->evercisegroup_id = $class->id;
                $slide->active = 1;
                $slide->save();
            }
        }

        return Redirect::route('admin.listClasses');


    }

}