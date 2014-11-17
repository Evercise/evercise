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

    public function publish()
    {
        $id = Input::get('id', false);
        $publish = Input::get('publish', false);

        $group = Evercisegroup::find($id);

        if ($group)
            $group->publish($publish);
        else
            return Response::json(
                [
                    'view' => View::make('v3.layouts.negative-alert')->with('message', 'Sessions could not be updated')->with('fixed', true)->render(),
                    'id'       => $id
                ]
            );

        return Response::json(
            [
                'view' => View::make('v3.layouts.positive-alert')->with('message', 'group '.($publish?'':'un').'published')->with('fixed', true)->render(),
                'id'       => $id
            ]
        );
    }
}