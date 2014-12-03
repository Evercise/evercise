<?php namespace ajax;

use Input, Response, Sentry, Evercisegroup, Validator, View, Redirect, Sessionmember, Evercisesession, Rating, Trainerhistory, Milestone, Event;


class RatingsController extends AjaxBaseController{

    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $validator = Validator::make(
            Input::all(),
            array(
                'sessionmember_id' => 'unique:ratings,sessionmember_id',
                'feedback_text' => 'required',
            )
        );
        if($validator->fails())
        {
            $result = [ 'validation_failed' => 1,'sessionmember_id' => Input::get('sessionmember_id'), 'errors' =>  $validator->errors()->toArray() ];
            return Response::json($result);
        }
        else
        {
            $user_id = Input::get('user_id');
            $sessionmember_id = Input::get('sessionmember_id');
            $user_created_id = $this->user->id;
            $stars = Input::get('stars');
            $comment = Input::get('feedback_text');
            $user_id = $this->user->id;

            $sessionmember = Sessionmember::find($sessionmember_id);
            $session_id = $sessionmember->evercisesession_id;
            $session = Evercisesession::find($session_id);
            $evercisegroup_id = $session->evercisegroup_id;
            $group = Evercisegroup::find($evercisegroup_id);

            // Check integrity of id's
            if (!$sessionmember)
                return [ 'validation_failed' => 1, 'errors' =>  ['message' => 'no sessionmember'] ];
            elseif ( $sessionmember->user_id != $user_created_id )
                return [ 'validation_failed' => 1, 'errors' =>  ['message' => 'ids do not match'] ];
            // Check group is in past
            elseif (strtotime($session->date_time) >= strtotime( date('Y-m-d H:i:s') ) )
                return [ 'validation_failed' => 1, 'errors' =>  ['message' => 'Cannot rate a session in the future'] ];

            Rating::create([
                'user_id' => $user_id,
                'sessionmember_id' => $sessionmember_id,
                'session_id' => $session_id,
                'evercisegroup_id' => $evercisegroup_id,
                'user_created_id' => $user_created_id,
                'stars' => $stars,
                'comment' => $comment
            ]);


            $timestamp = strtotime($session->date_time);
            $niceTime = date('h:ia', $timestamp);
            $niceDate = date('dS F Y', $timestamp);
            Trainerhistory::create(array('user_id'=> $user_id, 'type'=>'rated_session', 'display_name'=>$this->user->display_name, 'name'=>$group->name, 'time'=>$niceTime, 'date'=>$niceDate));
            Milestone::where('user_id', $this->user->id)->first()->add('review');

            event('rating.create', [$this->user, $group, $session]);

        }
        return Response::json(
            [
                'url' => route('users.edit', [ $this->user->id, 'attended'])
            ]
        );
    }
} 