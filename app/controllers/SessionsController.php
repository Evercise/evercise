<?php

class SessionsController extends \BaseController {

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


        $year = Input::get('year');
        $month = Input::get('month');
        $date = sprintf("%02s", Input::get('date'));
        $displayMonth = date('M', strtotime($year.'-'.$month.'-'.$date));
        $id = Input::get('evercisegroupId');

		$evercisegroup = Evercisegroup::where('id', $id)->first();

		$duration = $evercisegroup->default_duration;
		$price = $evercisegroup->default_price;
		$name = $evercisegroup->name;

		$hour = 12;
		$minute = 00;

		return View::make('sessions.create')
			->with('year',$year)
			->with('month',$month)
			->with('displayMonth',$displayMonth)
			->with('date',$date)
			->with('date',$date)
			->with('id',$id)
			->with('duration',$duration)
			->with('price',$price)
			->with('name',$name)
			->with('hour',$hour)
			->with('minute',$minute);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// echo 'Sessions store';
		// exit;

		$validator = Validator::make(
			Input::all(),
			array(
				's-evercisegroupId' => 'required',
				's-year' => 'required',
				's-month' => 'required',
				's-date' => 'required',
				's-time-hour' => 'required',
				's-time-minute' => 'required',
				's-price' => 'required|numeric|between:1,120',
				's-duration' => 'required|numeric|between:10,240',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else {

			$evercisegroupId = Input::get('s-evercisegroupId');
			$year = Input::get('s-year');
			$month = Input::get('s-month');
			$date = Input::get('s-date');
			$hour = Input::get('s-time-hour');
			$minute = Input::get('s-time-minute');
			$price = Input::get('s-price');
			$duration = Input::get('s-duration');
			//$customurl = Input::get('customurl');

			$time = $hour.':'.$minute.':00';

			$date_time = $year.'-'.$month.'-'.$date.' '.$time;

			if ( ! Sentry::check()) return 'Not logged in';

			
			if (Trainer::where('user_id', $this->user->id)->count())
				$trainer = Trainer::where('user_id', $this->user->id)->get()->first();

			$session = Evercisesession::create(array(
				'evercisegroup_id'=>$evercisegroupId,
				'date_time'=>$date_time,
				'price'=>$price,
				'duration'=>$duration
			));

			$evercisegroup = Evercisegroup::where('id', $evercisegroupId)->firstOrFail();

			$timestamp = strtotime($date_time);
			$niceTime = date('h:ia', $timestamp);
			$niceDate = date('dS F Y', $timestamp);
			Trainerhistory::create(array('user_id'=> $this->user->id, 'type'=>'created_session', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name, 'time'=>$niceTime, 'date'=>$niceDate));

			return Response::json(route('evercisegroups.index'));
			//return Response::json($evercisegroup); // for testing
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'Show';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return 'Edit';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return 'Update';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$evercisesession = Evercisesession::find($id);
		if ( !is_null($evercisesession) )
		{
			$evercisegroupId = $evercisesession->evercisegroup_id;
			$dateTime = $evercisesession->date_time;
			$price = $evercisesession->price;
			$duration = $evercisesession->duration;
			$user_id = Evercisegroup::where('id' , $evercisegroupId)->pluck('user_id');
			$undoDetails = ['mode'=>'delete', 'evercisegroup_id'=>$evercisegroupId, 'date_time'=>$dateTime, 'price'=>$price, 'duration'=>$duration, 'user_id' => $user_id];

			if ($user_id != $this->user->id) {
				return Response::json(['mode' => 'hack']);
			}
			Evercisesession::destroy($id);
			return Response::json($undoDetails);
		}
		else
		{
			$undoDetails = json_decode(Input::get('undo'));

			$session = Evercisesession::create(array(
				'evercisegroup_id' => $undoDetails->evercisegroup_id,
				'date_time' => $undoDetails->date_time,
				'price' => $undoDetails->price,
				'duration' => $undoDetails->duration
			));

			return Response::json(['mode' => 'undo', 'session_id' => $session->id]);
		}

		// TODO - refresh the session date_list on page load - to update id's
		// ( to fix bug caused by cached page after back button)

/*
		$evercisegroups = Evercisegroup::with('Evercisesession')->where('user_id', $this->user->id)->get();
		$sessionDates = array();
		$totalMembers = array();
		$totalCapacity = array();
		foreach ($evercisegroups as $key => $value) {

			$sessionDates[$key] = $Functions::arrayDate($value->Evercisesession->lists('date_time', 'id'));
			$totalCapacity[] =  $value->capacity;
			foreach ($value['Evercisesession'] as $k => $val) {
				$totalMembers[]= $val->members;
			}
		}

		$EGindex = Input::get('EGindex');
		return View::make('sessions.date_list')
				->with('key', $id)->with('sessionDates' , $sessionDates )
				->with('totalMembers' , $totalMembers )
				->with('totalCapacity' , $totalCapacity )
				->with('EGindex' , $EGindex );
*/
	}

	public function getMailAll($id)
	{

		return View::make('sessions.mail_all')->with('sessionId', $id);
	}

	public function postMailAll($id)
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'mail_subject' => 'required',
				'mail_body' => 'required',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else
		{
			$subject = Input::get('mail_subject');
			$body = Input::get('mail_body');

			$groupId = Evercisesession::where('id', $id)->pluck('evercisegroup_id');
			$group = Evercisegroup::where('id', $groupId)->first();
			$groupName = $group->name;
			$trainerName = $group->user->first_name.' '.$group->user->last_name;

			$users = Evercisesession::find($id)->users()->get();

			$userList = [];
			foreach ($users as $value)
			{
				$userList[$value->first_name . ' ' . $value->last_name] = $value->email;
			}


			Event::fire('session.mail_all', array(
	        	'trainer' => $trainerName, 
	        	'email' => $userList, 
	        	'name' => $groupName, 
	        	'subject' => $subject, 
	            'body' => $body
			));
		}

		return Response::json(['message' => 'group: '.$groupId.': '.$groupName.', session: '.$id]);
	}

	public function getMailOne($sessionId, $userId)
	{
		$userDetails = User::where('id', $userId)->select('first_name', 'last_name')->first();
		$name = $userDetails['first_name'] . ' ' . $userDetails['last_name'];

		return View::make('sessions.mail_one')->with('sessionId', $sessionId)->with('userId', $userId)->with('firstName', $name);
	}

	public function postMailOne($sessionId, $userId)
	{

		$validator = Validator::make(
			Input::all(),
			array(
				'mail_subject' => 'required',
				'mail_body' => 'required',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else
		{
			$subject = Input::get('mail_subject');
			$body = Input::get('mail_body');

			$groupId = Evercisesession::where('id', $sessionId)->pluck('evercisegroup_id');
			$group = Evercisegroup::where('id', $groupId)->first();
			$groupName = $group->name;
			$trainerName = $group->user->first_name.' '.$group->user->last_name;
			$userDetails = User::where('id', $userId)->select('first_name', 'last_name', 'email')->first();

			$name = $userDetails['first_name'] . ' ' . $userDetails['last_name'];
			$email = $userDetails['email'];
			$userList = [$name => $email];

			Event::fire('session.mail_all', array(
	        	'trainer' => $trainerName, 
	        	'email' => $userList, 
	        	'groupName' => $groupName, 
	        	'subject' => $subject, 
	            'body' => $body
			));
		}

		return Response::json(['message' => 'group: '.$groupId.': '.$groupName.', session: '.$sessionId]);
	}
	public function getMailTrainer($sessionId, $trainerId)
	{
		$session = Evercisesession::with('evercisegroup')->find($sessionId);
		//return Response::json($session->evercisegroup->name);
		$dateTime = $session->date_time;
		$groupName = $session->evercisegroup->name;

		$trainer = User::find($trainerId);
		$name = $trainer->first_name . ' ' . $trainer->last_name;

		return View::make('sessions.mail_trainer')
			->with('sessionId', $sessionId)
			->with('trainerId', $trainerId)
			->with('userId', $this->user->id)
			->with('dateTime', $dateTime)
			->with('groupName', $groupName)
			->with('name', $name);
	}

	public function postMailTrainer($sessionId, $trainerId)
	{

		$validator = Validator::make(
			Input::all(),
			array(
				'mail_subject' => 'required',
				'mail_body' => 'required',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else
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

			$userName = $this->user->first_name . ' ' . $this->user->last_name;

			Event::fire('session.mail_trainer', array(
	        	'email' => $userList, 
	        	'user' => $userName, 
	        	'groupName' => $groupName, 
	        	'dateTime' => $dateTime, 
	        	'subject' => $subject, 
	            'body' => $body
			));
		}



		return Response::json(['message' => 'group: '.$groupId.': '.$groupName.', session: '.$sessionId, 'callback' => 'mailSent']);
	}

	/*
	*
	*
	* check login status and either direct to checkout, or open login box
	*/
	public function checkout()
	{
		$sessionIds = json_decode(Input::get('session-ids'), true);
		$evercisegroupId = json_decode(Input::get('evercisegroup-id'), true);
		Session::put('sessionIds', $sessionIds);
		Session::put('evercisegroupId', $evercisegroupId);
		//return Response::json(['status' => Input::get('session-ids')]);

		$redirect_after_login_url = 'sessions.join.get';

		if (!$this->user)
		{
			//return View::make('auth.login')->with('redirect_after_login', false)->with('redirect_after_login_url', false);
			return View::make('auth.login')->with('redirect_after_login', true)->with('redirect_after_login_url', $redirect_after_login_url );
		}
		else
		{
			return Response::json(['status' => 'logged_in']);
		}
	}

	/*
	*
	*
	* confirmation for join sessions
	*/

	public function joinSessions()
	{
		//return 'nope';

		$sessionIds = Session::get('sessionIds', false);
		$evercisegroupId = Session::get('evercisegroupId', false);
		if(!$sessionIds) $sessionIds = json_decode(Input::get('session-ids'), true);
		if(!$evercisegroupId) $evercisegroupId = Input::get('evercisegroup-id');

		if (empty($sessionIds)) {
			return Redirect::route('evercisegroups.show' , [$evercisegroupId]);
		}


		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
		{

			$query->whereIn('id', $sessionIds);

		}), 'evercisesession')->find($evercisegroupId);

		if(Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count())
		{
			return Response::json('USER HAS ALREADY JOINED SESSION');
		}

		$userTrainer = User::find($evercisegroup->user_id);

		$members = [];
		$total = 0;
		$price = 0;
	    foreach ($evercisegroup->evercisesession as $key => $value)
	    {
			$members[] = count($value->sessionmembers); // Count those members
			++$total;
			$price = $price + $value->price;
	    }

	    $pricePence = SessionPayment::poundsToPennies($price);

	    Session::put('sessionIds', $sessionIds);
	    Session::put('amountToPay', $price);

	    JavaScript::put(array('initJoinEvercisegroup' => json_encode(array('sessions'=> $sessionIds,'total' => $total,'price' => $price)) ));

		return View::make('sessions.join')
					->with('evercisegroup' , $evercisegroup)
					->with('members' , $members)
					->with('userTrainer' , $userTrainer)
					->with('totalPrice' , $price)
					->with('totalPricePence' , $pricePence)
					->with('totalSessions' , $total)
					->with('sessionIds' , $sessionIds);
		//return var_dump($sessionId);
	}

	function payForSessions($id){

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


		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
		{

			$query->whereIn('id', $sessionIds);

		}), 'evercisesession')
		->find($evercisegroupId);

		//Make sure there is not already a matching entry in sessionmember
		if(Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count())
		{
			return Response::json('error: USER HAS ALREADY JOINED SESSION');
		}

		$userTrainer = User::find($evercisegroup->user_id);


		$members = [];
		$total = 0;
		$price = 0;
	    foreach ($evercisegroup->evercisesession as $key => $value)
	    {
			$members[] = count($value->sessionmembers); // Count those members
			++$total;
			$price = $price + $value->price;

			$timestamp = strtotime($value->date_time);
			$niceTime = date('h:ia', $timestamp);
			$niceDate = date('dS F Y', $timestamp);

		    Trainerhistory::create(array('user_id'=> $evercisegroup->user_id, 'type'=>'joined_session', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name, 'time'=>$niceTime, 'date'=>$niceDate));

	    }

	    $amountToPay = ( null !== Session::get('amountToPay')) ? Session::get('amountToPay') : $price;

		$evercoin = Evercoin::where('user_id', $this->user->id)->first();

		if ($amountToPay + Evercoin::evercoinsToPounds($evercoin->balance) < $price)
		{
			return Response::json(['message' => ' User has not got enough evercoins to make this transaction :'.$amountToPay]);
		}

		$deductEverciseCoins = Evercoin::poundsToEvercoins( $price - $amountToPay );

		$evercoin->withdraw($deductEverciseCoins);


		/*pivot current user with session via session members */
		$user->sessions()->attach($sessionIds, ['token' => $token , 'transaction_id' => $transactionId, 'payer_id' => $payerId, 'payment_method' => $paymentMethod ]);
		
		Event::fire('session.joined', array(
	        	'email' => $user->email, 
	        	'display_name' => $user->display_name, 
	        	'evercisegroup' => $evercisegroup, 
	        	'userTrainer' => $userTrainer, 
	        	'transactionId' => $transactionId, 
			));

		Session::forget('amountToPay');
		Session::forget('sessionIds');
		Session::forget('evercisegroupId');

		return View::make('sessions.confirmation')
					->with('evercisegroup' , $evercisegroup)
					->with('members' , $members)
					->with('userTrainer' , $userTrainer)
					->with('totalPrice' , $price)
					->with('totalSessions' , $total)
					->with('sessionIds' , $sessionIds)
					->with('amountPaid' , $amountToPay)
					->with('transactionId' , $transactionId)
					->with('evercoins' , $evercoin->balance)
					->with('deductEverciseCoins' , $deductEverciseCoins);
	}

	function getLeaveSession($id)
	{
		$session = Evercisesession::with('evercisegroup')
				->find($id);

		$sessionDate = new DateTime($session->date_time);
		$now = new DateTime();
		$twodaystime = (new DateTime())->add(new DateInterval('P2D'));
		$fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

		$evercoin = Evercoin::where('user_id',  $this->user->id)->first();

		//$everpound = $this->
		if ($sessionDate > $fivedaystime ){
			$status = 2;
			$refund = $session->price;

		} 
		elseif ($sessionDate > $twodaystime ){
			$status = 1;
			$refund = $session->price / 2;
		} 
		else {
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

		if ($sessionDate > $fivedaystime ) $status = 2;
		else if ($sessionDate > $twodaystime ) $status = 1;
		else $status = 0;

		if ($status > 0)
		{
			$user = User::find($this->user->id);
			$user->sessions()->detach($session->id);

			$refund = ($status == 1 ? ($session->price / 2) : $session->price);

			$refundInEvercoins = Evercoin::poundsToEvercoins($refund);

			$evercoin = Evercoin::where('user_id', $user->id)->first();
			$evercoin->deposit($refundInEvercoins);

			$evercisegroup = Evercisegroup::find($session->evercisegroup_id);
			$niceTime = date('h:ia', strtotime($session->date_time));
			$niceDate = date('dS F Y', strtotime($session->date_time));


			Trainerhistory::create(array('user_id'=> $evercisegroup->user_id, 'type'=>'left_session_'.($status == 1 ? 'half' : 'full'), 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name, 'time'=>$niceTime, 'date'=>$niceDate));

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

			return Response::json(['message' => ' session: '.$id, 'callback' => 'leftSession']);
		}
		else
		{
			return Response::json(['message' => ' Cannot leave session ']);
		}


	}
	/*public function getPayWithEvercoins($evercisegroupId)
	{
		//$session = Evercisesession::find($id);
		$sessionIds = Session::get('sessionIds');
		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
		{
			$query->whereIn('id', $sessionIds);

		}))->find($evercisegroupId);

		$price = 0;
	    foreach ($evercisegroup->evercisesession as $key => $value)
			$price = $price + $value->price;

	    $priceInEvercoins = Evercoin::poundsToEvercoins($price);

		$evercoin = Evercoin::where('user_id', $this->user->id)->first();

		return View::make('sessions.paywithevercoins')
			->with('evercisegroupId' , $evercisegroupId)
			->with('priceInEvercoins' , $priceInEvercoins)
			->with('evercoinBalance', $evercoin->balance);
	}*/


	public function redeemEvercoins($evercisegroupId)
	{
		$usecoins = Input::get('redeem');
		$sessionIds = Session::get('sessionIds');
		//$sessionIds = json_decode(Input::get('session-ids')) ;

		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
		{
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

		if($priceInEvercoins == $usecoins)
		{

			return Response::json([
				'callback' => 'openPopup',
				'popupHtml' => (string)View::make('sessions.checkoutwithevercoins')
				->with('evercisegroupId' , $evercisegroupId)
				->with('priceInEvercoins' , $priceInEvercoins)
				->with('evercoinBalance', $evercoin->balance)
				->with('usecoinsInPounds', $usecoinsInPounds)
			]);
			

		}
		else
		{

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
		Session::put('token', 'ever'.$transactionId);
		Session::put('transactionId', $transactionId);

		return $this->payForSessions($evercisegroupId);

	}

	public function getRefund($id){
		$session = Evercisesession::with('evercisegroup')
				->find($id);

		$sessionDate = new DateTime($session->date_time);
		$now = new DateTime();
		$twodaystime = (new DateTime())->add(new DateInterval('P2D'));
		$fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

		$evercoin = Evercoin::where('user_id',  $session->evercisegroup->user_id)->first();

		//$everpound = $this->
		if ($sessionDate > $fivedaystime ){
			$status = 2;
			$refund = $session->price;

		} 
		elseif ($sessionDate > $twodaystime ){
			$status = 1;
			$refund = $session->price / 2;
		} 
		else {
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
		if($validator->fails()) {

        	$result = array(
	            'validation_failed' => 1,
	            'errors' =>  $validator->errors()->toArray()
	         );	

			return Response::json($result);
	       
		}
		else
		{
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