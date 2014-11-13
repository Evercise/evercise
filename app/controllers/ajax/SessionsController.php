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
     * POST variables:
     * evercisesession_id
     * session_array = [[time, duration, tickets, price], ...]
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

     /** Save a new set of sessions
      *
      * POST variables:
      * evercisegroup_id
      * duration
      * tickets
      * price
      * session_array = [[date, time], [date, time], ...]
     *
     * @return Response
     */
    public function store()
    {
        $inputs = Input::all();
        $sessionArray = $inputs['session_array'];
        $evercisegroupId = $inputs['evercisegroup_id'];
        $time = $inputs['time'];
        $duration = $inputs['duration'];
        $tickets = $inputs['tickets'];
        $price = $inputs['price'];


        foreach($sessionArray as $sessionData)
        {
            if(!Evercisesession::validateAndStore([
                'date' => $sessionData,
                'time' => $time,
                'evercisegroup_id' => $evercisegroupId,
                'duration' => $duration,
                'tickets' => $tickets,
                'price' => $price,
            ]))
            {
                // A session has failed validation
            }
        }

        $groupId = $inputs['evercisegroupId'];
        $sessions = Evercisegroup::find($groupId)->Evercisesession;

        return Response::json([
            'view' => View::make('v3.classes.sessions_inline')->with('sessions', $sessions)->render(),
            'id'   => $groupId
        ]);


    }
}