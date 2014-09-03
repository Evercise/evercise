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
    public static function validateAndStore()
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
            Trainerhistory::create(array('user_id' => Sentry::getUser()->id, 'type' => 'created_session', 'display_name' => Sentry::getUser()->display_name, 'name' => $evercisegroupName, 'time' => $niceTime, 'date' => $niceDate));

            /* callback */
            Event::fire('session.create', [Sentry::getUser() ]);
            return Response::json(['callback' => 'gotoUrl', 'url' => route('evercisegroups.index')]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function deleteById($id)
    {
        try
        {
            $evercisesession = Evercisesession::findOrFail($id);

            $evercisegroupId = $evercisesession->evercisegroup_id;
            $user_id = Evercisegroup::where('id', $evercisegroupId)->pluck('user_id');
            if ($user_id != Sentry::getUser()->id) {
                Log::error('Attempted deletion of session by unauthorised user');
                return Response::json(['mode' => 'hack']);
            }
            $dateTime = $evercisesession->date_time;
            $price = $evercisesession->price;
            $duration = $evercisesession->duration;
            $undoDetails = ['mode' => 'delete', 'evercisegroup_id' => $evercisegroupId, 'date_time' => $dateTime, 'price' => $price, 'duration' => $duration, 'user_id' => $user_id];

            Evercisesession::destroy($id);
            Event::fire('session.delete', [Sentry::getUser(), $evercisesession ]);
            return Response::json($undoDetails);
        }
        catch (Exception $e)
        {
            $undoDetails = json_decode(Input::get('undo'));

            $evercisesession = Evercisesession::create(array(
                'evercisegroup_id' => $undoDetails->evercisegroup_id,
                'date_time' => $undoDetails->date_time,
                'price' => $undoDetails->price,
                'duration' => $undoDetails->duration
            ));

            Event::fire('session.create', [Sentry::getUser(), $evercisesession ]);
            return Response::json(['mode' => 'undo', 'session_id' => $evercisesession->id]);
        }

    }

    /**
     * @param $sessionId
     * @param $userList
     * @return \Illuminate\Http\JsonResponse
     */
    public static function mailMembers($sessionId, $userList)
    {
        if ( $response = static::validateMail() )
            return $response;

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

        Log::info('Members of Session '. $sessionId .' mailed by trainer');
        return Response::json(['message' => 'group: ' . $groupId . ': ' . $groupName . ', session: ' . $sessionId]);
    }

    /**
     * Return false if validation passes, otherwise return the error response
     *
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function validateMail()
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
            return false;
        }
    }

    /**
     * Return details of all the members signed up to a particular session
     *
     * @param $sessionId
     * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
     */
    public static function getMembers($sessionId)
    {
        $session = Evercisesession::where('id', $sessionId)->select('id')->with(['users' => function ($query) {
            $query->select('first_name', 'last_name', 'email');
        }
        ])->first();
        return $session->users;
    }

    /**
     * @param $sessionId
     * @param $trainerId
     * @return array
     */
    public static function mailTrainer($sessionId, $trainerId, $user)
    {
        $subject = Input::get('mail_subject');
        $body = Input::get('mail_body');

        $dateTime = Evercisesession::where('id', $sessionId)->pluck('date_time');
        $groupId = Evercisesession::where('id', $sessionId)->pluck('evercisegroup_id');
        $groupName = Evercisegroup::where('id', $groupId)->pluck('name');
        $trainerDetails = User::where('id', $trainerId)->select('first_name', 'last_name', 'email')->first();

        $name = $trainerDetails['first_name'] . ' ' . $trainerDetails['last_name'];
        $email = $trainerDetails['email'];
        $userList = [$name => $email];

        $userName = User::getName($user);

        Event::fire('session.mail_trainer', array(
            'email' => $userList,
            'user' => $userName,
            'groupName' => $groupName,
            'dateTime' => $dateTime,
            'subject' => $subject,
            'body' => $body
        ));
        return [$groupId, $groupName];
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public static function setCheckoutSessionData()
    {
        $sessionIds = json_decode(Input::get('session-ids'), true);
        $evercisegroupId = json_decode(Input::get('evercisegroup-id'), true);
        Session::put('sessionIds', $sessionIds);
        Session::put('evercisegroupId', $evercisegroupId);

    }

    /**
     * @return \Illuminate\View\View
     */
    public static function confirmJoinSessions($user)
    {
        $sessionIds = Session::get('sessionIds', false);
        $evercisegroupId = Session::get('evercisegroupId', false);
        if (!$sessionIds) $sessionIds = json_decode(Input::get('session-ids'), true);
        if (!$evercisegroupId) $evercisegroupId = Input::get('evercisegroup-id');

        if (empty($sessionIds)) {
            return Redirect::route('evercisegroups.show', [$evercisegroupId]);
        }


        $evercisegroup = Evercisegroup::with(array('evercisesession' => function ($query) use (&$sessionIds) {
            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')->find($evercisegroupId);

        if (Sessionmember::where('user_id', $user->id)->whereIn('evercisesession_id', $sessionIds)->count()) {
            return Response::json('USER HAS ALREADY JOINED SESSION');
        }

        $userTrainer = User::find($evercisegroup->user_id);

        $members = [];
        $total = 0;
        $price = 0;
        foreach ($evercisegroup->evercisesession as $key => $value) {
            $members[] = count($value->sessionmembers); // Count those members
            ++$total;
            $price = $price + $value->price;
        }

        $pricePence = SessionPayment::poundsToPennies($price);

        Session::put('sessionIds', $sessionIds);
        Session::put('amountToPay', $price);

        return View::make('sessions.join')
            ->with('evercisegroup', $evercisegroup)
            ->with('members', $members)
            ->with('userTrainer', $userTrainer)
            ->with('totalPrice', $price)
            ->with('totalPricePence', $pricePence)
            ->with('totalSessions', $total)
            ->with('sessionIds', $sessionIds);
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