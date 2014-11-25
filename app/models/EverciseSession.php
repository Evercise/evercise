<?php

/**
 * Class Evercisesession
 */
class Evercisesession extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['evercisegroup_id', 'date_time', 'price', 'duration', 'members_emailed', 'tickets'];

    protected $editable = ['date_time', 'price', 'duration', 'members'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisesessions';

    /**
     * @param $inputs
     * @return \Illuminate\View\View
     */
    public static function getCreateForm($inputs)
    {
        $date = sprintf("%02s", Input::get('date'));

        $displayMonth = date('M', strtotime($inputs['year'] . '-' . $inputs['month'] . '-' . $date));

        $evercisegroup = Evercisegroup::select('default_duration', 'default_price', 'name' )->where('id', $inputs['evercisegroupId'])->first();

        $duration = $evercisegroup->default_duration;
        $price = $evercisegroup->default_price;
        $name = $evercisegroup->name;

        /* Set default time */
        $hour = 12;
        $minute = 00;

        return [
            'year' => $inputs['year'],
            'month' => $inputs['month'],
            'displayMonth' => $displayMonth,
            'date' => $date,
            'evercisegroupId' => $inputs['evercisegroupId'],
            'duration' => $duration,
            'price' => $price,
            'name' => $name,
            'hour' => $hour,
            'minute' => $minute
        ];
    }

    /**
     * $sessionData = [evercisegroup_id, date, time, duration, tickets, price]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateAndStore($sessionData)
    {

        $validator = Validator::make(
            $sessionData,
            [
                'evercisegroup_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                'tickets' => 'required',
                'price' => 'required|numeric|between:1,'.Config::get('values')['max_price'],
                'duration' => 'required|numeric|between:10,240',
            ]
        );
        if ($validator->fails()) {
            return false;
        }
        else {
            $date_time = $sessionData['date'] . ' ' . $sessionData['time'];

            $evercisegroupName = Evercisesession::create([
                'evercisegroup_id' => $sessionData['evercisegroup_id'],
                'date_time' => $date_time,
                'price' => $sessionData['price'],
                'duration' => $sessionData['duration'],
                'tickets' => $sessionData['tickets'],
            ])->evercisegroup->name;

            $timestamp = strtotime($date_time);
            $niceTime = date('h:ia', $timestamp);
            $niceDate = date('dS F Y', $timestamp);
            Trainerhistory::create(array('user_id' => Sentry::getUser()->id, 'type' => 'created_session', 'display_name' => Sentry::getUser()->display_name, 'name' => $evercisegroupName, 'time' => $niceTime, 'date' => $niceDate));

            /* callback */
            Event::fire('session.create', [Sentry::getUser() ]);
            return true;
        }
    }

    public static function toDateTime($date, $time)
    {
        $date = strtotime($date);
        $date_str = date("Y-m-d H:i:s", $date);
        $date_time_str = str_replace('00:00:00', $time, $date_str);
        $date_time = strtotime($date_time_str);
    }

    public function validateAndUpdate($sessionData, $userId)
    {

        $validator = Validator::make(
            $sessionData,
            [
                'tickets' => 'required',
                'time' => 'required',
                'price' => 'required|numeric|between:1,'.Config::get('values')['max_price'],
                'duration' => 'required|numeric|between:10,240',
            ]
        );
        if ($validator->fails()) {
            return false;
        }
        else {
            if (! $this->evercisegroup->user_id == $userId)
                return false;

            $currentDate = strtotime($this->date_time);
            $date_str = date("Y-m-d", $currentDate);
            $date_time_str = $date_str . ' ' . $sessionData['time'];

            $this->update([
                'date_time' => $date_time_str,
                'price' => $sessionData['price'],
                'duration' => $sessionData['duration'],
                'tickets' => $sessionData['tickets'],
            ]);

            return true;
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
            $undoDetails = ['mode' => 'delete', 'id' => $id,  'evercisegroup_id' => $evercisegroupId, 'date_time' => $dateTime, 'price' => $price, 'duration' => $duration, 'user_id' => $user_id];

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
    public static function mailTrainer($sessionId, $trainerId)
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

        $userName = User::getName(Sentry::getUser());

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
     * @param $evercisegroupId
     * @param $sessionIds
     * @return \Illuminate\View\View
     */
    public static function confirmJoinSessions($evercisegroupId, $sessionIds)
    {
        $evercisegroup = Evercisegroup::with(array('evercisesession' => function ($query) use (&$sessionIds) {
            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')->find($evercisegroupId);

        if (Sessionmember::where('user_id', Sentry::getUser()->id)->whereIn('evercisesession_id', $sessionIds)->count()) {
            return 0;
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


        return [
            'evercisegroup' => $evercisegroup,
            'members' => $members,
            'userTrainer' => $userTrainer,
            'totalPrice' => $price,
            'totalPricePence' => $pricePence,
            'totalSessions' => $total,
            'sessionIds' => $sessionIds,
        ];
    }

    /**
     * Adds the user to the sessions they have purchased.  Takes an array of Cart rows, which must be of the same Evercisegroup
     *
     * @param $evercisegroupId
     * @param $cartRows
     * @param $token
     * @param $transactionId
     * @param $paymentMethod
     * @param $amount
     * @param $user
     * @return bool
     */
    public static function addSessionMember($evercisegroupId, $cartRows, $token, $transactionId, $paymentMethod, $amount, $user)
    {

        /* get session ids from Cart*/
        $sessionIds = [];
        foreach($cartRows as $row)
            array_push($sessionIds, $row->options->sessionId);

        $evercisegroup = Evercisegroup::getGroupWithSpecificSessions($evercisegroupId, $sessionIds);

        //Make sure there is not already a matching entry in sessionmember
/*        if (Sessionmember::where('user_id', $user->id)->whereIn('evercisesession_id', $sessionIds)->count()) {
            return Response::json('error: USER HAS ALREADY JOINED SESSION');
        }*/

        $userTrainer = User::find($evercisegroup->user_id);

        $members = [];
        $total = 0;
        $price = 0;
        foreach ($evercisegroup->evercisesession as $key => $value) {
            $members[] = count($value->sessionmembers); // Count those members
            ++$total;
            $price = $price + $value->price;

            $timestamp = strtotime($value->date_time);
            $niceTime = date('h:ia', $timestamp);
            $niceDate = date('dS F Y', $timestamp);

            Trainerhistory::create(array('user_id' => $evercisegroup->user_id, 'type' => 'joined_session', 'display_name' => $user->display_name, 'name' => $evercisegroup->name, 'time' => $niceTime, 'date' => $niceDate));
        }
    //return var_dump($user);

        /* Pivot current user with session via session members */
        $user->sessions()->attach($sessionIds, ['token' => $token, 'transaction_id' =>  $transactionId, 'payer_id' => $user->id, 'payment_method' => $paymentMethod]);

        self::sendSessionJoinedEmail($evercisegroup, $userTrainer, $transactionId);

        Event::fire('session.payed', [$user, $evercisegroup]);
        Log::info('User '.$user->display_name.' has paid for sessions '.implode(',', $sessionIds).' of group '.$evercisegroupId);

        self::newMemberAnalytics($transactionId, $amount, $evercisegroup, $sessionIds);


        return 'done';
    }

    /**
     * @param $transactionId
     * @param $amountToPay
     * @param $evercisegroup
     * @param $sessionIds
     */
    public static function newMemberAnalytics($transactionId, $amountToPay, $evercisegroup, $sessionIds)
    {
// Grab the "foo" instance
        $gaTracker = UniversalAnalytics::get('trackerName');

        // Require the ecommerce JS file:
        $gaTracker->ga('require', 'ecommerce', 'ecommerce.js');

        // Setup a transaction:
        $gaTracker->ga('ecommerce:addTransaction', [
            'id' => $transactionId,
            'affiliation' => 'evercise',
            'revenue' => $amountToPay,
        ]);
        // Setup a item for the class:
        $gaTracker->ga('ecommerce:addItem', [
            'id' => $evercisegroup->id,
            'name' => $evercisegroup->name,
            'quantity' => count($sessionIds),
        ]);
    }

    /**
     * @param $evercisegroup
     * @param $userTrainer
     * @param $transactionId
     */
    public static function sendSessionJoinedEmail($evercisegroup, $userTrainer, $transactionId)
    {
        Event::fire('session.joined', array(
            'email' => Sentry::getUser()->email,
            'display_name' => Sentry::getUser()->display_name,
            'evercisegroup' => $evercisegroup,
            'userTrainer' => $userTrainer,
            'transactionId' => $transactionId,
        ));
    }

    /**
     * Generate the for for leaving a session
     *
     * @param $evercisesessionId
     * @return \Illuminate\View\View
     */
    public static function getLeaveSessionForm($evercisesessionId)
    {
        $session = Evercisesession::with('evercisegroup')
            ->find($evercisesessionId);

        $sessionDate = new DateTime($session->date_time);

        $evercoin = Evercoin::where('user_id', Sentry::getUser()->id)->first();

        if ($sessionDate > Evercisesession::getFullRefundCutOff()) {
            $status = 2;
            $refund = $session->price;

        } elseif ($sessionDate > Evercisesession::getHalfRefundCutOff()) {
            $status = 1;
            $refund = $session->price / 2;
        } else {
            $status = 0;
            $refund = 0;
        }

        $refundInEvercoins = Evercoin::poundsToEvercoins($refund);
        $evercoinBalanceAfterRefund = $evercoin->balance + $refundInEvercoins;

        return [
            'session' => $session,
            'refund' => $refund,
            'refundInEvercoins' => $refundInEvercoins,
            'evercoinBalanceAfterRefund' => $evercoinBalanceAfterRefund,
            'evercoin' => $evercoin,
            'status' => $status,
        ];
    }

    /**
     * @return DateTime
     */
    public static function getFullRefundCutOff()
    {
        return (new DateTime())->add(new DateInterval('P'.Config::get('values')['full_refund_cut_off'].'D'));
    }

    /**
     * @return DateTime
     */
    public static function getHalfRefundCutOff()
    {
        return (new DateTime())->add(new DateInterval('P'.Config::get('values')['half_refund_cut_off'].'D'));
    }

    /**
     * @param $evercisesessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function processLeaveSession($evercisesessionId)
    {
        $session = Evercisesession::find($evercisesessionId);

        $sessionDate = new DateTime($session->date_time);

        /* Determine whether the user can leave, and how much they will receive in refund */
        if ($sessionDate > Evercisesession::getFullRefundCutOff()) $status = 2;
        else if ($sessionDate > Evercisesession::getHalfRefundCutOff()) $status = 1;
        else $status = 0;

        if ($status > 0) {

            Sentry::getUser()->sessions()->detach($session->id);

            $refund = ($status == 1 ? ($session->price / 2) : $session->price);

            $refundInEvercoins = Evercoin::poundsToEvercoins($refund);

            $evercoin = Evercoin::where('user_id', Sentry::getUser()->id)->first();
            $evercoin->deposit($refundInEvercoins);

            $evercisegroup = Evercisegroup::find($session->evercisegroup_id);
            $niceTime = date('h:ia', strtotime($session->date_time));
            $niceDate = date('dS F Y', strtotime($session->date_time));

            Trainerhistory::create(array('user_id' => $evercisegroup->user_id, 'type' => 'left_session_' . ($status == 1 ? 'half' : 'full'), 'display_name' => Sentry::getUser()->display_name, 'name' => $evercisegroup->name, 'time' => $niceTime, 'date' => $niceDate));

            $trainer = User::find($evercisegroup->user_id);


            self::sendLeavingEmails($trainer, $evercisegroup, date('dS M y', strtotime($session->date_time)));

            Event::fire('session.left', [Sentry::getUser(), $evercisegroup, $session]);
            return Response::json(['message' => ' session: ' . $evercisesessionId, 'callback' => 'leftSession']);
        } else {
            return Response::json(['message' => ' Cannot leave session ']);
        }
    }

    /**
     * @param $trainer
     * @param $evercisegroup
     * @param $sessionDate
     */
    public static function sendLeavingEmails($trainer, $evercisegroup, $sessionDate)
    {
        Event::fire('session.userLeft', array(
            'email' => Sentry::getUser()->email,
            'display_name' => Sentry::getUser()->display_name,
            'everciseGroup' => $evercisegroup->name,
            'everciseSession' => $sessionDate,
        ));

        Event::fire('session.trainerLeft', array(
            'email' => $trainer->email,
            'display_name' => $trainer->display_name,
            'user_name' => Sentry::getUser()->display_name,
            'everciseGroup' => $evercisegroup->name,
            'everciseSession' => $sessionDate,
        ));
    }

    /**
     * @param $evercisegroupId
     * @param $usecoins
     * @param $sessionIds
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getRedeemEvercoinsView($evercisegroupId, $usecoins, $sessionIds)
    {
        $evercisegroup = Evercisegroup::with(array('evercisesession' => function ($query) use (&$sessionIds) {
            $query->whereIn('id', $sessionIds);

        }))->find($evercisegroupId);

        $price = 0;
        foreach ($evercisegroup->evercisesession as $key => $value)
            $price = $price + $value->price;
        $priceInEvercoins = Evercoin::poundsToEvercoins($price);


        // Check if more coins are selected than are needed.
        if ($usecoins > $priceInEvercoins)
            $usecoins = $priceInEvercoins;

        //Check user has tried to use more evercoins than they have. if so, use every last one.
        $evercoin = Evercoin::where('user_id', Sentry::getUser()->id)->first();
        if ($usecoins > $evercoin->balance)
            $usecoins = $evercoin->balance;

        $usecoinsInPounds = Evercoin::evercoinsToPounds($usecoins);
        $amountRemaining = $price - $usecoinsInPounds;

        $evercoin = Evercoin::where('user_id', Sentry::getUser()->id)->first();

        return [
            'priceInEvercoins' => $priceInEvercoins,
            'usecoins' => $usecoins,
            'evercoinBalance' => $evercoin->balance,
            'usecoinsInPounds' => $usecoinsInPounds,
            'amountRemaining' => $amountRemaining,
        ];

    }

    /**
     * Generates some details for the evercoin payment, and returns them instead of getting them from the session.
     * to be used by 'addSessionMember()'
     *
     * @return array
     */
    public static function generateEvercoinPaymentDetails()
    {
        $transactionId = Functions::randomPassword(16);

        return [
            'paymentMethod' => 'evercoins',
            'token' => 'ever' . $transactionId,
            'transactionId' => $transactionId
        ];
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

    public function formattedDuration()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        return ($hours ? $hours . ' hours ' : '') . ( $minutes . ' minutes');
    }

    public function formattedDate()
    {
        return  date('D M dS Y', strtotime($this->date_time));
    }

    public function formattedTime()
    {
        return  date('H:i', strtotime($this->date_time));
    }

    public function remainingTickets()
    {
        return $this->tickets - count($this->sessionmembers);
    }




}