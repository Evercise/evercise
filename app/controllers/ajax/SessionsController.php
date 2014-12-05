<?php namespace ajax;
use DateTime;
use Input, Response, Evercisegroup, Evercisesession, View;

class SessionsController extends AjaxBaseController{

    public function getSessionsInline()
    {
        $evercisegroupId = Input::get('groupId');
        $id = Input::get('id');
        $sessions = Evercisegroup::find($evercisegroupId)->Futuresessions;
        $userId = \Sentry::getUser()->id;

        if($id != $userId){
            $type = 'user';
        }
        else{
            $type = 'edit';
        }

        return Response::json([
            'view' => View::make('v3.classes.sessions_inline')
                ->with('sessions', $sessions)
                ->with('evercisegroup_id', $evercisegroupId)
                ->with('mode', $type)->render(),
            'id'   => $evercisegroupId
        ]);
    }

    /**
     * Update a set of sessions.
     *
     * POST variables:
     *
     * id = []
     * time = []
     * duration = []
     * tickets = []
     * price = []
     *
     * @return Response
     */
    public function update()
    {
        $preview = Input::get('preview');
        $sessionIds = Input::get('id');
        $time_array = Input::get('time');
        $duration_array = Input::get('duration');
        $tickets_array = Input::get('tickets');
        $price_array = Input::get('price');
        $evercisegoupId = Input::get('$evercisegoupId');

        $userId = \Sentry::getUser()->id;

        foreach($sessionIds as $key => $id)
        {
            $inputs = [
                'time' => $time_array[$key],
                'duration' => $duration_array[$key],
                'tickets' => $tickets_array[$key],
                'price' => $price_array[$key],
            ];

            $session = Evercisesession::find($id);
            //return $session->validateAndUpdate($inputs, $userId);
            if(!$session->validateAndUpdate($inputs, $userId))
                return Response::json(
                    [
                        'view' => View::make('v3.layouts.negative-alert')->with('message', 'Sessions could not be updated')->with('fixed', true)->render(),
                        'id'       => $id
                    ]
                );
        }



        if(isset($preview) && $preview == 'yes'){
            return Response::json(
                [
                    'url' => route('evercisegroups.show',[$evercisegoupId,'preview'] )
                ]
            );
        }
        else
        {
            return Response::json(
                [
                    'view' => View::make('v3.layouts.positive-alert')->with('message', 'your sessions were updated successfully')->with('fixed', true)->render(),
                    'id'       => $id
                ]
            );
        }

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
      * session_array = [date, date, ...]
     *
     * @return Response
     */
    public function store()
    {
        $inputs = Input::all();
        $sessionArray = explode(',', $inputs['session_array']);
        $evercisegroupId = $inputs['evercisegroup_id'];
        $time = $inputs['time'];
        $duration = $inputs['duration'];
        $tickets = $inputs['tickets'];
        $price = $inputs['price'];

        //return $sessionArray;

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


    public function getParticipants() {
        $sessionId = Input::get('session_id');
        $participants = Evercisesession::getMembers($sessionId);
        return view('v3.sessions.participants', compact('participants'));
    }

}