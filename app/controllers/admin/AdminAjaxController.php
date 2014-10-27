<?php


/**
 * Class AdminAjaxController
 */
class AdminAjaxController extends AdminController
{

    /**
     *
     */
    public function __construct()
    {

        parent::__construct();

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
            'message' => 'Password reset.  Email:' . $user->email
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckUrl()
    {

        $this->beforeFilter('csrf', array('on' => 'post'));

        $url = $this->request->get('url');

        /** CHeck if the URL is in the articles */
        $check = Articles::where('permalink', $url)->count();

        if ($check > 0) {
            return Response::json(['error' => true]);
        }

        /** CHeck if the URL is in the ArticleCategories */
        $check = ArticleCategories::where('permalink', $url)->count();

        if ($check > 0) {
            return Response::json(['error' => true]);
        }


        return Response::json(['error' => false]);
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

    public function saveTags()
    {
        $tags = implode(',',Input::get('tags'));
        $id = Input::get('id');

        Gallery::where('id', $id)->update(['keywords' => $tags]);

        return Response::json(['saved' => true]);
    }


    public function galleryUploadFile()
    {
        if ($file = Request::file('file')) {

            $name = $file->getClientOriginalName();
            /** Save the image name without the Prefix to the DB */

            $save = false;
            foreach (Config::get('evercise.gallery.sizes') as $img) {

                $file_name = $img['prefix'] . '_' . $name;

                $image = Image::make($_FILES['file']['tmp_name'])->fit(
                    $img['width'],
                    $img['height']
                )->save(public_path() . '/img/gallery/' . $file_name);


                if ($image) {
                    $save = true;
                }

            }

            if ($save) {
                Gallery::create(['image' => $name, 'counter' => Config::get('evercise.gallery.image_counter', 3)]);
                return '/img/gallery/thumb_' . $name;
            }
        }

        return false;


    }

}