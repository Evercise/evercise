<?php

class SessionsController extends \BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($evercisegroup_id = '')
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // The slider is initialised in JS from the view, as the document.ready has already run

        return Evercisesession::getCreateForm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return Evercisesession::validateAndStore($this->user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return 'Show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return 'Edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return 'Update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        return Evercisesession::deleteById($id, $this->user);

    }

    /**
     * Show the popup form for mailing all users signed up to a session
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getMailAll($id)
	{
		return View::make('sessions.mail_all')->with('sessionId', $id);
	}

    /**
     * Send the mail to all users signed up to a session
     *
     * @param $sessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailAll($sessionId)
	{
        $userList = [];
        foreach (Evercisesession::getMembers($sessionId) as $user) {
            $userList[$user->first_name . ' ' . $user->last_name] = $user->email;
        }

        return Evercisesession::mailMembers($sessionId, $userList);
    }

    /**
     * Show the form to send a mail to a single user
     *
     * @param $sessionId
     * @param $userId
     * @return \Illuminate\View\View
     */
    public function getMailOne($sessionId, $userId)
	{
		$userDetails = User::where('id', $userId)->select('first_name', 'last_name')->first();
		$name = $userDetails['first_name'] . ' ' . $userDetails['last_name'];

        return View::make('sessions.mail_one')->with('sessionId', $sessionId)->with('userId', $userId)->with('firstName', $name);
    }

    /**
     * Send the mail to a single user
     *
     * @param $sessionId
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailOne($sessionId, $userId)
	{
        $userDetails = User::getNameAndEmail($userId);
        $userList = [$userDetails['name'] => $userDetails['email']];

        return Evercisesession::mailMembers($sessionId, $userList);
	}

    /**
     * Get for to send an email to the trainer of a group
     *
     * @param $sessionId
     * @param $trainerId
     * @return \Illuminate\View\View
     */
    public function getMailTrainer($sessionId, $trainerId)
	{
		$session = Evercisesession::with('evercisegroup')->find($sessionId);
		$dateTime = $session->date_time;
		$groupName = $session->evercisegroup->name;

        $name = User::getName($trainerId);

		return View::make('sessions.mail_trainer')
			->with('sessionId', $sessionId)
			->with('trainerId', $trainerId)
			->with('userId', $this->user->id)
			->with('dateTime', $dateTime)
			->with('groupName', $groupName)
			->with('name', $name);
	}

    /**
     * @param $sessionId
     * @param $trainerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailTrainer($sessionId, $trainerId)
	{
        list($groupId, $groupName) = Evercisesession::mailTrainer($sessionId, $trainerId, $this->user);

		return Response::json(['message' => 'group: '.$groupId.': '.$groupName.', session: '.$sessionId, 'callback' => 'mailSent']);
	}

    /**
     * check login status and either direct to checkout, or open login box
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function checkout()
	{
        Evercisesession::setCheckoutSessionData();

        $redirect_after_login_url = 'sessions.join.get';

        if (!$this->user) {
            return View::make('auth.login')->with('redirect_after_login', true)->with('redirect_after_login_url', $redirect_after_login_url);
        } else {
            return Response::json(['status' => 'logged_in']);
        }
	}

	/**
	*
	*
	* confirmation for join sessions
	*/
    public function joinSessions()
    {
        //return 'nope';

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

        if (Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count()) {
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
        //return var_dump($sessionId);
    }

    function payForSessions($id)
    {
        /* get session ids */
        $sessionIds = Session::get('sessionIds');
        /* get currnet user */
        $user = User::find($this->user->id);

        $evercisegroupId = $id;

        /* get token */
        $token = Session::get('token');

        /* get transaction id */
        $transactionId = Session::get('transactionId');

        /* get Payer id */
        $payerId = Session::get('payerId');

        /* get payment method */
        $paymentMethod = Session::get('paymentMethod');


        $evercisegroup = Evercisegroup::with(array('evercisesession' => function ($query) use (&$sessionIds) {

            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')
            ->find($evercisegroupId);

        //Make sure there is not already a matching entry in sessionmember
        if (Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count()) {
            return Response::json('error: USER HAS ALREADY JOINED SESSION');
        }

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

            Trainerhistory::create(array('user_id' => $evercisegroup->user_id, 'type' => 'joined_session', 'display_name' => $this->user->display_name, 'name' => $evercisegroup->name, 'time' => $niceTime, 'date' => $niceDate));

        }

        $amountToPay = (null !== Session::get('amountToPay')) ? Session::get('amountToPay') : $price;

        $evercoin = Evercoin::where('user_id', $this->user->id)->first();

        if ($amountToPay + Evercoin::evercoinsToPounds($evercoin->balance) < $price) {
            return Response::json(['message' => ' User has not got enough evercoins to make this transaction :' . $amountToPay]);
        }

        $deductEverciseCoins = Evercoin::poundsToEvercoins($price - $amountToPay);

        $evercoin->withdraw($deductEverciseCoins);


        /*pivot current user with session via session members */
        $user->sessions()->attach($sessionIds, ['token' => $token, 'transaction_id' => $transactionId, 'payer_id' => $payerId, 'payment_method' => $paymentMethod]);

        Event::fire('session.joined', array(
            'email' => $user->email,
            'display_name' => $user->display_name,
            'evercisegroup' => $evercisegroup,
            'userTrainer' => $userTrainer,
            'transactionId' => $transactionId,
        ));

        Event::fire('session.payed', [$user, $evercisegroup]);

        // Grab the "foo" instance
        $gaTracker = UniversalAnalytics::get('trackerName');

        // Require the ecommerce JS file:
        $gaTracker->ga('require', 'ecommerce', 'ecommerce.js');

        // Setup a transaction:
        $gaTracker->ga('ecommerce:addTransaction', [
            'id' => $transactionId,
            'affiliation' => 'evercise',
            'revenue'     => $amountToPay,
        ]);
        // Setup a item for the class:
        $gaTracker->ga('ecommerce:addItem', [
            'id' => $evercisegroup->id,
            'name' => $evercisegroup->name,
            'quantity'     => count($sessionIds),
        ]);


        Session::forget('amountToPay');
        Session::forget('sessionIds');
        Session::forget('evercisegroupId');




		return View::make('sessions.confirmation')
            ->with('evercisegroup', $evercisegroup)
            ->with('members', $members)
            ->with('userTrainer', $userTrainer)
            ->with('totalPrice', $price)
            ->with('totalSessions', $total)
            ->with('sessionIds', $sessionIds)
            ->with('amountPaid', $amountToPay)
            ->with('transactionId', $transactionId)
            ->with('evercoins', $evercoin->balance)
            ->with('deductEverciseCoins', $deductEverciseCoins);
	}

    function getLeaveSession($id)
    {
        $session = Evercisesession::with('evercisegroup')
            ->find($id);

        $sessionDate = new DateTime($session->date_time);
        $now = new DateTime();
        $twodaystime = (new DateTime())->add(new DateInterval('P2D'));
        $fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

        $evercoin = Evercoin::where('user_id', $this->user->id)->first();

        //$everpound = $this->
        if ($sessionDate > $fivedaystime) {
            $status = 2;
            $refund = $session->price;

        } elseif ($sessionDate > $twodaystime) {
            $status = 1;
            $refund = $session->price / 2;
        } else {
            $status = 0;
            $refund = 0;
        }

        $refundInEvercoins = Evercoin::poundsToEvercoins($refund);
        $evercoinBalanceAfterRefund = $evercoin->balance + $refundInEvercoins;

        return View::make('sessions.leave')
            ->with('session', $session)
            ->with('refund', $refund)
            ->with('refundInEvercoins', $refundInEvercoins)
            ->with('evercoinBalanceAfterRefund', $evercoinBalanceAfterRefund)
            ->with('evercoin', $evercoin)
            ->with('status', $status);
    }

    public function postLeaveSession($id)
    {
        $session = Evercisesession::find($id);

        $sessionDate = new DateTime($session->date_time);
        $now = new DateTime();
        $twodaystime = (new DateTime())->add(new DateInterval('P2D'));
        $fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

        if ($sessionDate > $fivedaystime) $status = 2;
        else if ($sessionDate > $twodaystime) $status = 1;
        else $status = 0;

        if ($status > 0) {
            $user = User::find($this->user->id);
            $user->sessions()->detach($session->id);

            $refund = ($status == 1 ? ($session->price / 2) : $session->price);

            $refundInEvercoins = Evercoin::poundsToEvercoins($refund);

            $evercoin = Evercoin::where('user_id', $user->id)->first();
            $evercoin->deposit($refundInEvercoins);

            $evercisegroup = Evercisegroup::find($session->evercisegroup_id);
            $niceTime = date('h:ia', strtotime($session->date_time));
            $niceDate = date('dS F Y', strtotime($session->date_time));


            Trainerhistory::create(array('user_id' => $evercisegroup->user_id, 'type' => 'left_session_' . ($status == 1 ? 'half' : 'full'), 'display_name' => $this->user->display_name, 'name' => $evercisegroup->name, 'time' => $niceTime, 'date' => $niceDate));

            Event::fire('session.userLeft', array(
                'email' => $user->email,
                'display_name' => $user->display_name,
                'everciseGroup' => $evercisegroup->name,
                'everciseSession' => date('dS M y', strtotime($session->date_time)),
            ));

            $trainer = User::find($evercisegroup->user_id);

            Event::fire('session.trainerLeft', array(
                'email' => $trainer->email,
                'display_name' => $trainer->display_name,
                'user_name' => $user->display_name,
                'everciseGroup' => $evercisegroup->name,
                'everciseSession' => date('dS M y', strtotime($session->date_time)),
            ));

            Event::fire('session.left', [$user, $evercisegroup, $session]);
            return Response::json(['message' => ' session: ' . $id, 'callback' => 'leftSession']);
        } else {
            return Response::json(['message' => ' Cannot leave session ']);
        }


    }


    public function redeemEvercoins($evercisegroupId)
    {
        $usecoins = Input::get('redeem');
        $sessionIds = Session::get('sessionIds');
        //$sessionIds = json_decode(Input::get('session-ids')) ;

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
        $evercoin = Evercoin::where('user_id', $this->user->id)->first();
        if ($usecoins > $evercoin->balance)
            $usecoins = $evercoin->balance;

        $usecoinsInPounds = Evercoin::evercoinsToPounds($usecoins);
        $amountRemaining = $price - $usecoinsInPounds;

        Session::put('amountToPay', $amountRemaining);

        $evercoin = Evercoin::where('user_id', $this->user->id)->first();

        if ($priceInEvercoins == $usecoins) {

            return Response::json([
                'callback' => 'openPopup',
                'popup' => (string)View::make('sessions.checkoutwithevercoins')
                    ->with('evercisegroupId', $evercisegroupId)
                    ->with('priceInEvercoins', $priceInEvercoins)
                    ->with('evercoinBalance', $evercoin->balance)
                    ->with('usecoinsInPounds', $usecoinsInPounds)
            ]);


        } else {

            return Response::json([
                'usecoins' => $usecoins,
                'amountRemaining' => $amountRemaining,
                'usecoinsInPounds' => $usecoinsInPounds,
                'callback' => 'paidWithEvercoins'
            ]);
        }
    }


    public function postPayWithEvercoins($evercisegroupId)
    {
        $transactionId = Functions::randomPassword(16);
        Session::put('payerId', $this->user->id);
        Session::put('paymentMethod', 'evercoins');
        Session::put('token', 'ever' . $transactionId);
        Session::put('transactionId', $transactionId);

        return $this->payForSessions($evercisegroupId);

    }

    public function getRefund($id)
    {
        $session = Evercisesession::with('evercisegroup')
            ->find($id);

        $sessionDate = new DateTime($session->date_time);
        $now = new DateTime();
        $twodaystime = (new DateTime())->add(new DateInterval('P2D'));
        $fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

        $evercoin = Evercoin::where('user_id', $session->evercisegroup->user_id)->first();

        //$everpound = $this->
        if ($sessionDate > $fivedaystime) {
            $status = 2;
            $refund = $session->price;

        } elseif ($sessionDate > $twodaystime) {
            $status = 1;
            $refund = $session->price / 2;
        } else {
            $status = 0;
            $refund = 0;
        }

        $refundInEvercoins = Evercoin::poundsToEvercoins($refund);
        $evercoinBalanceAfterRefund = $evercoin->balance + $refundInEvercoins;

        return View::make('sessions.refund_request')
            ->with('session', $session)
            ->with('refund', $refund)
            ->with('refundInEvercoins', $refundInEvercoins)
            ->with('evercoinBalanceAfterRefund', $evercoinBalanceAfterRefund)
            ->with('evercoin', $evercoin)
            ->with('status', $status);
    }


    public function postRefund($sessionId)
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

        } else {
            $subject = Input::get('mail_subject');
            $body = Input::get('mail_body');
            $contact = 'contact@evercise.com';

            $groupId = Evercisesession::where('id', $sessionId)->pluck('evercisegroup_id');
            $groupName = Evercisegroup::where('id', $groupId)->pluck('name');

            Event::fire('session.refund', array(

                'email' => $contact,
                'userName' => $this->user->display_name,
                'userEmail' => $this->user->email,
                'groupName' => $groupName,
                'subject' => $subject,
                'body' => $body
            ));
        }

        return Response::json(['callback' => 'successAndRefresh']);
    }


}