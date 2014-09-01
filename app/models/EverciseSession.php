<?php

/**
 * Class Evercisesession
 */
class Evercisesession extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('evercisegroup_id', 'date_time', 'members', 'price', 'duration', 'members_emailed');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisesessions';

    /**
     * @return \Illuminate\View\View
     */
    public static function getCreateForm()
    {
        $year = Input::get('year');
        $month = Input::get('month');
        $id = Input::get('evercisegroupId');
        $date = sprintf("%02s", Input::get('date'));

        $displayMonth = date('M', strtotime($year . '-' . $month . '-' . $date));

        $evercisegroup = Evercisegroup::select('default_duration', 'default_price', 'name' )->where('id', $id)->first();

        $duration = $evercisegroup->default_duration;
        $price = $evercisegroup->default_price;
        $name = $evercisegroup->name;

        /* Set default time */
        $hour = 12;
        $minute = 00;

        return View::make('sessions.create')
            ->with('year', $year)
            ->with('month', $month)
            ->with('displayMonth', $displayMonth)
            ->with('date', $date)
            ->with('date', $date)
            ->with('id', $id)
            ->with('duration', $duration)
            ->with('price', $price)
            ->with('name', $name)
            ->with('hour', $hour)
            ->with('minute', $minute);
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateAndStore($user)
    {
        $validator = Validator::make(
            Input::all(),
            array(
                's-evercisegroupId' => 'required',
                's-year' => 'required',
                's-month' => 'required',
                's-date' => 'required',
                's-time-hour' => 'required',
                's-time-minute' => 'required',
                's-price' => 'required|numeric|between:1,1000',
                's-duration' => 'required|numeric|between:10,240',
            )
        );
        if ($validator->fails()) {
            $result = array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
            return Response::json($result);
        }
        else {
            $inputs = Input::all();

            $time = $inputs['s-time-hour'] . ':' . $inputs['s-time-minute'] . ':00';
            $date_time = $inputs['s-year'] . '-' . $inputs['s-month'] . '-' . $inputs['s-date'] . ' ' . $time;

            Evercisesession::create(array(
                'evercisegroup_id' => $inputs['s-evercisegroupId'],
                'date_time' => $date_time,
                'price' => $inputs['s-price'],
                'duration' => $inputs['s-duration']
            ));

            $evercisegroupName = Evercisegroup::where('id', $inputs['s-evercisegroupId'])->firstOrFail()->pluck('name');

            $timestamp = strtotime($date_time);
            $niceTime = date('h:ia', $timestamp);
            $niceDate = date('dS F Y', $timestamp);
            Trainerhistory::create(array('user_id' => $user->id, 'type' => 'created_session', 'display_name' => $user->display_name, 'name' => $evercisegroupName, 'time' => $niceTime, 'date' => $niceDate));

            /* callback */
            Event::fire('session.create', [$user ]);
            return Response::json(['callback' => 'gotoUrl', 'url' => route('evercisegroups.index')]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function deleteById($id, $user)
    {
        $evercisesession = Evercisesession::select('evercisegroup_id', 'date_time', 'price', 'duration')->where('id', $id)->firstOrFail();
        if (!is_null($evercisesession)) {
            $evercisegroupId = $evercisesession->evercisegroup_id;
            $dateTime = $evercisesession->date_time;
            $price = $evercisesession->price;
            $duration = $evercisesession->duration;
            $user_id = Evercisegroup::where('id', $evercisegroupId)->firstOrFail()->pluck('user_id');
            $undoDetails = ['mode' => 'delete', 'evercisegroup_id' => $evercisegroupId, 'date_time' => $dateTime, 'price' => $price, 'duration' => $duration, 'user_id' => $user_id];

            if ($user_id != $user->id) {
                return Response::json(['mode' => 'hack']);
            }
            Evercisesession::destroy($id);
            return Response::json($undoDetails);
        } else {
            $undoDetails = json_decode(Input::get('undo'));

            $session = Evercisesession::create(array(
                'evercisegroup_id' => $undoDetails->evercisegroup_id,
                'date_time' => $undoDetails->date_time,
                'price' => $undoDetails->price,
                'duration' => $undoDetails->duration
            ));

            Event::fire('session.delete', [$user, $evercisesession ]);
            return Response::json(['mode' => 'undo', 'session_id' => $session->id]);
        }

    }

    /**
     * @param $sessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function mailMembers($sessionId, $userList)
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'mail_subject' => 'required',
                'mail_body' => 'required',
            )
        );
        if ($validator->fails()) {
            $result = array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
            return Response::json($result);
        }
        else {
            $subject = Input::get('mail_subject');
            $body = Input::get('mail_body');

            $groupId = Evercisesession::where('id', $sessionId)->pluck('evercisegroup_id');
            //$group = Evercisegroup::where('id', $groupId)->first();
            $group = Evercisegroup::where('id', $groupId)->with(['User' => function($query)
            {
                $query->select('first_name', 'last_name');
            }
            ])->first();
            $groupName = $group->name;
            $trainerName = $group->user->first_name . ' ' . $group->user->last_name;

            Event::fire('session.mail_all', array(
                'trainer' => $trainerName,
                'email' => $userList,
                'name' => $groupName,
                'subject' => $subject,
                'body' => $body
            ));
        }

        return Response::json(['message' => 'group: ' . $groupId . ': ' . $groupName . ', session: ' . $sessionId]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessionmembers()
    {
        return $this->hasMany('Sessionmember');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('User', 'sessionmembers', 'evercisesession_id', 'user_id')->withPivot('id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sessionpayment()
    {
        return $this->hasOne('Sessionpayment');
    }


}