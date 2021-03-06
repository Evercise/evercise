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
                $r->_source->radius,
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
    public function downloadStats()
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
        $size = $this->input->get('length', 200000);


        $results = $this->elastic->searchStats(['size' => $size, 'from' => $from, 'search' => $search['value']]);


        $response['recordsTotal'] = $results->total;
        $response['recordsFiltered'] = $results->total;

        $rows = [];

        foreach ($results->hits as $r) {

            $rows[] = [
                'search' => $r->_source->search,
                'size' => $r->_source->size,
                'results' => $r->_source->results,
                'user_id' => $r->_source->user_id,
                'name' => $r->_source->name,
                'date' => $r->_source->date
            ];

        }

        $this->download_send_headers("search_stats_" . date("Y-m-d") . ".csv");

        return $this->array2csv($rows);
    }


    public function importStatsToDB()
    {
        $this->elastic = new Elastic(
            Geotools::getFacadeRoot(),
            $this->evercisegroup,
            Es::getFacadeRoot(),
            $this->log
        );
        $search = $this->input->get('search');

        $from = $this->input->get('start', 0);
        $size = $this->input->get('length', 200000);


        $results = $this->elastic->searchStats(['size' => $size, 'from' => $from]);


        $rows = [];

        $allowed = [
            'search',
            'size',
            'user_id',
            'user_ip',
            'radius',
            'url',
            'url_type',
            'name',
            'lat',
            'lng',
            'results'
        ];

        StatsModel::truncate();

        $split = 1000;


        foreach ($results->hits as $r) {
            $row = [];
            foreach ($allowed as $key) {
                $row[$key] = $r->_source->{$key};
            }
            $row['created_at'] = $r->_source->date;

            $rows[] = $row;

            if(count($rows) == $split) {
                StatsModel::insert($rows);
                $rows = [];
            }
        }

        StatsModel::insert($rows);


        DB::select( DB::raw("UPDATE search_stats set search = replace(search, '?utm_source=Google', '') WHERE 1") );



        return Redirect::to('/admin/search/stats');
    }

    public function download_send_headers($filename)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return NULL;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);

        return ob_get_clean();
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
        $assNumbers = explode(',', Input::get('update_associations'));

        $editsubcategoryIds = explode(',', Input::get('update_categories'));

        $subcategoryChanges = [];
        foreach($editsubcategoryIds as $subcatId)
        {
            $subcategoryChanges[$subcatId] = Input::get('categories_'.$subcatId);
        }


        //return $subcategoryChanges;

        $type = Input::get('type', '');


        $associations = [];

        foreach ($assNumbers as $assId) {
            array_push($associations, [$assId => Input::get('associations_' . $assId)]);
        }

        Subcategory::editSubcategoryCategories($subcategoryChanges);
        Subcategory::editAssociations($associations);
        Subcategory::editTypes($type);

        //return Response::json(['callback' => 'adminPopupMessage', 'message' => count($associations).' : '.Input::get('associations_'.'3')]);
        return Response::json(['callback' => 'successAndRefresh']);

    }

    public function updateCategories()
    {
        $order = explode(',',Input::get('order'));

        $cats = Category::get();
        foreach ($cats as $cat) {
            $cat->visible = Input::get('visible_'.$cat->id);
            $cat->save();
        }


        $newOrder = [];
        $count=0;
        foreach($order as $id)
        {
            $count++;
            $newOrder[$id] = $count;
        }
        Category::editOrder($newOrder);
        //return $visibleSettings;

        return Response::json(['callback' => 'successAndRefresh']);
    }

    public function updateCategory()
    {
        $id = Input::get('id');
        if(! $id)
            return false;

        $name = Input::get('name');
        $description = Input::get('description');
        $popularGroups = Input::get('popular_groups');
        $popularSubcats = Input::get('popular_subcategories');

        $popularGroupsCSV = $popularGroups ? implode(',', $popularGroups) : '';
        $popularSubcatsCSV = $popularSubcats ? implode(',', $popularSubcats) : '';

        $category = Category::find($id);

        $category->name = $name;
        $category->description = $description;
        $category->popular_classes = $popularGroupsCSV;
        $category->popular_subcategories = $popularSubcatsCSV;
        $category->save();

        return Redirect::route('admin.categories');
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
    public function deleteSubcategory()
    {

        $id = Input::get('id', FALSE);

        if ($id) {
            $data = DB::table('evercisegroup_subcategories')->where('subcategory_id', $id)->delete();


            DB::table('subcategories')->where('id', $id)->delete();

            return Response::json(['success' => TRUE, 'id' => $id]);
        }

        return Response::json(['success' => FALSE, 'id' => $id]);
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
        $tags = implode(',', Input::get('tags', []));
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

        if (!empty($gallery->id)) {
            @unlink('files/gallery_defaults/' . $gallery->image);
            $gallery->delete();
        }


        return Response::json(['deleted' => 'true', 'id' => $id]);
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

            $name = 'g_' . rand(1, 1000) . '-' . $file->getClientOriginalName();
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
        $checked = Input::get('checked', 'true');

        $slider = Slider::where(['evercisegroup_id' => $id])->first();
        if ($checked == 'true') {
            $slider->active = 1;
        } else {
            $slider->active = 0;
        }

        return $slider->save();

    }

    public function setClassImage()
    {
        $class_id = Input::get('class_id');
        $image_id = Input::get('image_id');

        $class = Evercisegroup::find($class_id);


        $save_image = Gallery::selectImage($image_id, $class->user, $class->name);

        $class->image = $save_image;
        $class->save();

        event('class.index.single', [$class->id]);

        return Response::json(['ok' => '1']);


    }


    public function deleteClass()
    {

        $id = Input::get('id');

        $evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);
        if (!$evercisegroup) {
            return Response::json(['deleted' => FALSE, 'message' => 'No Evercise group found. Refresh page!']);
        }


        $deleted = $evercisegroup->adminDeleteIfNoSessions();


        event('class.index.single', [$id]);

        return Response::json([
            'deleted' => $deleted,
            'message' => ($deleted ? 'Class Deleted' : 'Please delete Class Sessions first and then you can delete classes')
        ]);

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


    public function modalClassCategories($class_id = 0)
    {

        $evercisegroup = $this->evercisegroup->find($class_id);

        $subcategories_obj = $evercisegroup->subcategories()->get();

        $subcategories = [];
        foreach ($subcategories_obj as $s) {
            $subcategories[$s->id] = TRUE;
        }


        $all_subs = Subcategory::orderBy('name', 'asc')->get();


        $view = View::make('admin.modal.categories', compact('evercisegroup', 'subcategories', 'all_subs'))->render();


        return Response::json(['view' => $view, 'error' => FALSE]);


    }


    public function saveClassCategories()
    {

        $class = $this->evercisegroup->find($this->input->get('class_id'));
        $categories = $this->input->get('cat');

        if (strpos($categories, ',') !== FALSE) {
            $categories = explode(',', $categories);
        } else {
            $categories = [$categories];
        }

        if ($class) {

            $class->subcategories()->detach();
            if (count($categories) > 0) {
                $class->subcategories()->attach($categories);
            }
        }


        return Response::json(['res' => $class->subcategories()->get()->toArray(), 'error' => FALSE]);


    }


    public function runIndexer()
    {
        $indexer = App::make('events\Indexer');

        return $indexer->indexAll();

    }

}