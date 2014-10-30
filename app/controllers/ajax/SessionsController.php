<?php namespace ajax;
use Input, Response, Evercisegroup, View;

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
}