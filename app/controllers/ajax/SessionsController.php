<?php namespace ajax;
use DateTime;
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
     * Update a set of sessions.
     *
     * POST variables:
     * session_array = [[id, date, time, duration, tickets, price], ...]
     *
     * @return Response
     */
    public function update()
    {
        $sessionEdits = Input::get('session_array');
        foreach($sessionEdits as $sessionData)
        {
            $id = $sessionData['id'];

            $inputs = [
                'time' => $sessionData['time'],
                'duration' => $sessionData['duration'],
                'tickets' => $sessionData['tickets'],
                'price' => $sessionData['price'],
            ];

            $session = Evercisesession::find($id);
            $session->updateSession($inputs);

        }

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

        foreach($sessionArray as $date)
        {

            if(!Evercisesession::validateAndStore([
                'date' => $date,
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

        $sessions = Evercisegroup::find($evercisegroupId)->evercisesession;

        return Response::json([
            'view' => View::make('v3.classes.update_sessions_inline')->with('sessions', $sessions)->render(),
            'id'   => $evercisegroupId
        ]);


    }
}