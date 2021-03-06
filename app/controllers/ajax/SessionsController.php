<?php namespace ajax;

use DateTime;
use Input, Response, Evercisegroup, Evercisesession, View;
use Carbon\Carbon;

class SessionsController extends AjaxBaseController
{

    public function getSessionsInline()
    {
        $evercisegroupId = Input::get('groupId');
        $id = Input::get('id');
        //$sessions = Evercisegroup::find($evercisegroupId)->futuresessions;

        $sessions = Evercisesession::where('evercisegroup_id', $evercisegroupId)
            ->where('date_time', '>=', Carbon::now())
            ->orderBy('date_time', 'asc')
            ->paginate(5);

        $userId = \Sentry::getUser()->id;

        if ($id != $userId) {
            $type = 'user';
        } else {
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
        $evercisegroupId = Input::get('evercisegroup_id');

        //return 'id:'.\Evercisegroup::getSlug($evercisegroupId);


        $userId = \Sentry::getUser()->id;

        if (!empty($sessionIds)) {
            if (!is_array($sessionIds)) {
                $sessionIds = [$sessionIds];
            }
            if (!is_array($time_array)) {
                $time_array = [$time_array];
            }
            if (!is_array($duration_array)) {
                $duration_array = [$duration_array];
            }
            if (!is_array($tickets_array)) {
                $tickets_array = [$tickets_array];
            }
            if (!is_array($price_array)) {
                $price_array = [$price_array];
            }

            foreach ($sessionIds as $key => $id) {
                $inputs = [
                    'time'     => $time_array[$key],
                    'duration' => $duration_array[$key],
                    'tickets'  => $tickets_array[$key],
                    'price'    => $price_array[$key],
                ];

                $session = Evercisesession::find($id);
                if ($session) {
                    //return $session->validateAndUpdate($inputs, $userId);
                    $updateResponse = $session->validateAndUpdate($inputs, $userId);

                    if ($updateResponse['validation_failed']) {
                        return Response::json(
                            [
                                'view' => View::make('v3.layouts.negative-alert')->with('message',
                                    'Sessions could not be updated')->with('fixed', TRUE)->render(),
                                'errors' => $updateResponse,
                                'id' => $id
                            ]
                        );
                    }
                }else
                {
                    return Response::json(
                        [
                            'view' => View::make('v3.layouts.negative-alert')->with('message',
                                'Session '.$id.' could not be found')->with('fixed', TRUE)->render(),
                            'errors' => ['sessions'=>'session cannot be found'],
                            'id' => $id
                        ]
                    );
                }
            }
        }


        if (isset($preview) && $preview == 'yes') {
            return Response::json(
                [
                    'url' => route('class.show', [\Evercisegroup::getSlug($evercisegroupId), 'preview'])
                ]
            );
        } else {
            //return 'here: '.$preview;
            return Response::json(
                [
                    'view' => View::make('v3.layouts.positive-alert')->with('message',
                        'your sessions were updated successfully')->with('fixed', TRUE)->render(),
                    'id'   => $id
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
        $id = Input::get('id', FALSE);

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
        $evercisegroupId = isset($inputs['evercisegroup_id']) ? $inputs['evercisegroup_id'] : $inputs['evercisegroupId'];
        $time = $inputs['time'];
        $duration = $inputs['duration'];
        $tickets = isset($inputs['tickets']) ? $inputs['tickets'] : $inputs['members'];
        $price = $inputs['price'];


        if (Input::get('session_array', FALSE)) {
            $sessionArray = explode(',', $inputs['session_array']);
        } elseif (Input::get('date', FALSE)) {
            $sessionArray = [$inputs['date']];
        } else {
            return Response::json([
                    'view' => View::make('v3.layouts.negative-alert')->with('message',
                        'No sessions specified')->with('fixed', TRUE)->render()
                ]);
        }

        foreach ($sessionArray as $date) {

            if (!Evercisesession::validateAndStore([
                'date'             => $date,
                'time'             => $time,
                'evercisegroup_id' => $evercisegroupId,
                'duration'         => $duration,
                'tickets'          => $tickets,
                'price'            => $price,
            ])
            ) {
                // A session has failed validation
            }

        }

        $sessions = Evercisegroup::find($evercisegroupId)->futuresessions;

        event('class.index.single', [$evercisegroupId]);

        $update = Input::get('update', FALSE);

        if($update){
            return Response::json([
                'view' => View::make('v3.classes.update_sessions_inline')->with('sessions', $sessions)->render(),
                'id'   => $evercisegroupId
            ]);
        }
        else{
            return Response::json([
                'view' => View::make('v3.classes.sessions_inline')->with('sessions', $sessions)->with('evercisegroup_id', $evercisegroupId)->render(),
                'id'   => $evercisegroupId
            ]);
        }



    }


    public function getParticipants()
    {
        $sessionId = Input::get('session_id');
        $participants = Evercisesession::getMembers($sessionId);

        return view('v3.sessions.participants', compact('participants'));
    }

    public function getSlug()
    {
        return $this->evercisegroup->slug;
    }


    public function getMembers()
    {

        $user = \Sentry::getUser();
        $session_id = Input::get('session_id', FALSE);

        if (!$session_id) {
            return Response::json([
                'view'  => FALSE,
                'error' => 'You need to specify a session id'
            ]);
        }

        $evercisesession = Evercisesession::find($session_id);
        $evercisegroup = Evercisegroup::find($evercisesession->evercisegroup_id);

        if ($user->id !== $evercisegroup->user_id) {

            return Response::json([
                'view'  => FALSE,
                'error' => 'You  dont have permissions to view this list'
            ]);
        }

        if ($evercisesession->sessionmembers()->count() == 0) {

            return Response::json([
                'view'  => FALSE,
                'error' => 'No Members on this list'
            ]);
        }

        $sessionmembers = $evercisesession->users;

        return Response::json([
            'view' => View::make('v3.classes.sessions_list_users',
                compact('evercisesession', 'evercisegroup', 'sessionmembers'))->render()
        ]);


    }

}