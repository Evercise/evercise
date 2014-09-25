<?php

/**
 * Class Rating
 */
class Rating extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array(
        'id',
        'user_id',
        'sessionmember_id',
        'session_id',
        'evercisegroup_id',
        'user_created_id',
        'stars',
        'comment'
    );

    /**
     * @var string
     */
    protected $table = 'ratings';

    /* the user this rating belongs to */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /* the user that rated this class */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rator()
    {
        return $this->belongsTo('User', 'user_created_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup', 'evercisegroup_id');
    }

    public static function validateAndStore($inputs)
    {

        $validator = Validator::make(
            $inputs,
            array(
                'sessionmember_id' => 'unique:ratings,sessionmember_id',
                'feedback_text' => 'required',
            )
        );
        if($validator->fails()) {
            $result = array(
                'validation_failed' => 1,
                'errors' =>  $validator->errors()->toArray()
            );

            return $result;
        }
        else
        {
            $user_id = $inputs['user_id'];
            $sessionmember_id = $inputs['sessionmember_id'];
            $session_id = $inputs['session_id'];
            $evercisegroup_id = $inputs['evercisegroup_id'];
            $user_created_id = Sentry::getUser()->id;
            $stars = $inputs['stars'];
            $comment = $inputs['feedback_text'];

            $sessionmember = Sessionmember::find($sessionmember_id);
            $group = Evercisegroup::find($evercisegroup_id);
            $session = Evercisesession::find($session_id);

            // Check integrity of id's
            if (!$sessionmember)
                return ['callback' => 'sendhome' ,'message' => 'no sessionmember'];
            elseif ( $sessionmember->user_id != $user_created_id || $user_id != $group->user_id || $sessionmember->evercisesession_id != $session_id || $session->evercisegroup_id != $evercisegroup_id)
                return ['callback' => 'sendhome' ,'message' => 'ids do not match'];
            // Check group is in past
            elseif (strtotime($session->date_time) >= strtotime( date('Y-m-d H:i:s') ) )
                return ['callback' => 'sendhome' ,'message' => 'Session is in the future'];

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
            Trainerhistory::create(array('user_id'=> $user_id, 'type'=>'rated_session', 'display_name'=>Sentry::getUser()->display_name, 'name'=>$group->name, 'time'=>$niceTime, 'date'=>$niceDate));
            Milestone::where('user_id', Sentry::getUser()->id)->first()->add('review');

            Event::fire('rating.create', [Sentry::getUser(), $group, $session ]);

        }

        return ['callback' => 'refreshpage' ,'notification' => $session_id];
    }
}