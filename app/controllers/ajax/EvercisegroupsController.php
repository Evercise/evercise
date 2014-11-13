<?php namespace ajax;

use Input, Response, Evercisegroup, Sentry;

class EvercisegroupsController extends AjaxBaseController{


    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    /**
     * POST variables:
     * name
     * venue_id
     * description
     * image
     * category_array (array of id's)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $inputs = Input::all();

        $response = Evercisegroup::validateAndStore($inputs, $this->user);

        return $response;
    }

    /**
     * POST variables:
     * name
     * venue_id
     * description
     * image
     * category_array (array of id's)
     *
     * @param $id
     * @throws \Exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $inputs = Input::all();

        $response = Evercisegroup::find($id)->validateAndUpdate($inputs, $this->user);

        return $response;
    }
}