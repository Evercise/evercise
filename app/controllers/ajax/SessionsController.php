<?php namespace ajax;
use Input, Response, Evercisegroup, Evercisesession, View;

class SessionsController extends AjaxBaseController{

    public function getSessionsInline()
    {
        $groupId = Input::get('groupId');
        $sessions = Evercisegroup::find($groupId)->Evercisesession;

        return Response::json([
            'view' => View::make('v3.classes.sessions_inline')->with('sessions', $sessions)->render(),
            'id'   => $groupId
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        $id = Input::get('id', false);

        $data = [];
        if(Input::get('date_time', false)) $data['date_time'] = Input::get('date_time');
        if(Input::get('duration', false)) $data['duration'] = Input::get('duration');
        if(Input::get('members', false)) $data['members'] = Input::get('members');
        if(Input::get('price', false)) $data['price'] = Input::get('price');

        $session = Evercisesession::find($id);
        $session->updateSession($data);

        return Response::json(
            [
                'message'  => 'success',
                'id'       => $id
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $inputs = Input::all();

        if( Evercisesession::validateAndStore($inputs) )
        {
            $groupId = $inputs['evercisegroupId'];
            $sessions = Evercisegroup::find($groupId)->Evercisesession;

            return Response::json([
                'view' => View::make('v3.classes.sessions_inline')->with('sessions', $sessions)->render(),
                'id'   => $groupId
            ]);
        }
    }
}