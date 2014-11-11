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

        $inputs = [];
        if(Input::get('time', false)) $inputs['time'] = Input::get('time');
        if(Input::get('duration', false)) $inputs['duration'] = Input::get('duration');
        if(Input::get('members', false)) $inputs['members'] = Input::get('members');
        if(Input::get('price', false)) $inputs['price'] = Input::get('price');

        $session = Evercisesession::find($id);
        $session->updateSession($inputs);

        return Response::json(
            [
                'view' => View::make('v3.layouts.positive-alert')->with('message', 'your session was updated successfully')->with('fixed', true)->render(),
                'id'       => $id
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        $id = Input::get('id', false);
        return Evercisesession::deleteById($id);
    }

     /** Store a newly created resource in storage.
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