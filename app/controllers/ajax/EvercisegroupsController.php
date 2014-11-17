<?php namespace ajax;

use Input, Response, Evercisegroup, Sentry, View;

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

        if($group->user_id != $this->user->id)
            return Response::json(
                [
                    'view' => View::make('v3.layouts.negative-alert')->with('message', 'Class does not belong to user')->with('fixed', true)->render(),
                    'state' => 'hack'
                ]
            );


        if ($group)
            $group->publish($publish);
        else
            return Response::json(
                [
                    'view' => View::make('v3.layouts.negative-alert')->with('message', 'Class not found')->with('fixed', true)->render(),
                    'state' => 'error'
                ]
            );

        return Response::json(
            [
                'view' => View::make('v3.layouts.positive-alert')->with('message', 'Class '.($publish?'':'un').'published')->with('fixed', true)->render(),
                'state' => $publish
            ]
        );
    }
}