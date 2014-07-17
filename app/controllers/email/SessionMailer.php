<?php namespace email;

class SessionMailer extends Mailer {

	/**
	 * Outline all the events this class will be listening for. 
	 * @param  [type] $events 
	 * @return void         
	 */
	public function subscribe($events)
	{
		$events->listen('session.mail_all', 'email\SessionMailer@mailAll');
		$events->listen('session.mail_trainer', 'email\SessionMailer@mailTrainer');
		$events->listen('session.userLeft', 'email\SessionMailer@userLeaveSession');
		$events->listen('session.trainerLeft', 'email\SessionMailer@trainerLeaveSession');
		$events->listen('session.upcoming_session', 'email\SessionMailer@remind');
		$events->listen('session.joined', 'email\SessionMailer@joined');
		$events->listen('session.refund', 'email\SessionMailer@refundRequest');
	}


	public function remind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail)
	{

		$data['userList'] = $userList;


		// ------ SEND EMAIL TO TRAINER ------
		$body = '
			<p>Hi '.$trainerName.',</p>
			<br>
			<p>You have arranged the class '.$group.' to take place tomorrow '.date('d-M-Y', strtotime($dateTime)).' at '.date('h:m', strtotime($dateTime)).'. We have attached a list of participants to this email.</p>
			<br>
			<p>Please note that more participants can join up until one hour before the class is due to commence.</p>
			<p>We hope it goes well!</p>
			<br>
			<p>If you have any problems, please get in contact. We’re always happy to help.</p>
		';
		

		$subject = 'Class reminder & participant list';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = $subject;
		$data['mainHeader'] = 'Feeling prepared?';
		$data['subHeader'] = 'Your arranged class will take place in less than 24 hours.';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('evercisegroups', 'Class hub');
		$data['linkLabel'] = 'Go to your class hub: ';

		$this->sendTo($trainerEmail, $subject, $view, $data );


		// ------ SEND EMAIL TO USERS ------
		foreach($userList as $name => $email)
		{
			$body = '
				<p>Hi '.$name.',</p>
				<br>
				<p>Don`t forget you have a class scheduled for tomorrow!</p>
				<br>
				<ul>
					<li>Class name: '.$group.'</li>
					<li>Date and time: '.date('d-M-Y', strtotime($dateTime)).' at '.date('h:m', strtotime($dateTime)).'</li>
					<li>Location: '.$location.'</li>
					<li>Name of trainer: '.$trainerName.'</li>
				</ul>
				<br>
				<p>Remember to bring a bottle of water and your ID. For those of you with Twitter accounts, let your friends know what you`re up to by using the hashtag #Evercise.</p>
				<br>
				<p>Most importantly, have fun!</p>
			';
			

			$subject = 'Evercise class reminder';
			//$view = 'emails.auth.welcome'; // use for validation email
			$view = 'emails.template';
			$data['title'] = $subject;
			$data['mainHeader'] = 'Feeling prepared?';
			$data['subHeader'] = 'Your class is tomorrow. Please find all the useful details below.';
			$data['body'] = $body;
			$data['link'] = HTML::linkRoute('evercisegroups', 'Class page');
			$data['linkLabel'] = 'Visit your class page: ';


			$data['name'] = $name;
			$this->sendTo($email, $subject, $view, $data );
		}
	}


	public function mailAll($userList, $group, $subject, $body)
	{
		$subject = $subject;
		$view = 'emails.session.all';
		$data['body'] = $body;
		$data['group'] = $group;
		$data['subject'] = $subject;

		foreach($userList as $name => $email)
		{
			$data['name'] = $name;
			$this->sendTo($email, $subject, $view, $data );
		}
	}

	// needs more descriptive name
	public function mailTrainer($trainer, $user, $group, $dateTime, $subject, $body)
	{
		$subject = $subject;
		$view = 'emails.session.trainer';
		$data['user_name'] = $user;
		$data['body'] = $body;
		$data['group'] = $group;
		$data['dateTime'] = $dateTime;
		$data['subject'] = $subject;

		foreach($trainer as $name => $email)
		{
			$data['name'] = $name;
			$this->sendTo($email, $subject, $view, $data );
		}
	}

	// used to mail user to onfirm leaving a session

	public function userLeaveSession($email, $display_name, $everciseGroup, $everciseSession)
	{
		$subject = 'Sorry to see you leave';
		$view = 'emails.session.userLeft';
		$data['display_name'] = $display_name;
		$data['email'] = $email;
		$data['everciseGroup'] = $everciseGroup;
		$data['everciseSession'] = $everciseSession;

		return $this->sendTo($email, $subject, $view, $data );
	}

	// used to mail trainer when someone leaves a session

	public function trainerLeaveSession($email, $display_name, $user_name, $everciseGroup, $everciseSession)
	{
		$subject = 'Someone has left your class';
		$view = 'emails.session.trainerLeft';
		$data['display_name'] = $display_name;
		$data['user_name'] = $user_name;
		$data['email'] = $email;
		$data['everciseGroup'] = $everciseGroup;
		$data['everciseSession'] = $everciseSession;

		return $this->sendTo($email, $subject, $view, $data );
	}

	// for whe  a user joines sessions

	public function joined( $email, $display_name, $evercisegroup, $userTrainer, $transactionId)
	{
		$subject = 'You have joined a class.';
		$view = 'emails.session.joined';
		$data['email'] = $email;
		$data['display_name'] = $display_name;
		$data['evercisegroup_name'] = $evercisegroup->name;
		$data['userTrainer_display_name'] = $userTrainer->display_name;
		$data['transactionId'] = $transactionId;
		foreach($evercisegroup->evercisesession as $key => $session){
			$data['sessions'][] = $session->date_time;
		}

		return $this->sendTo($email, $subject, $view, $data );
	}

	// for contacting us about a refund request

	public function refundRequest($email, $userName, $userEmail , $group, $subject, $body)
	{
		$subject = $subject;
		$view = 'emails.session.refundRequest';
		$data['userName'] = $userName;
		$data['userEmail'] = $userEmail;
		$data['body'] = $body;
		$data['group'] = $group;
		$data['subject'] = $subject;

		return $this->sendTo($email, $subject, $view, $data );
	}

	






}