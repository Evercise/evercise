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


	public function mailAll($trainer, $userList, $group, $subject, $messageBody)
	{

		// ------ SEND EMAIL TO PARTICIPANT ------
		$subject = 'You have a new message.';
		$view = 'emails.template';
		$data['title'] = $subject;
		$data['mainHeader'] = 'You have a new message in your Evercise inbox.';
		$data['subHeader'] = 'Your fitness trainer has contacted you.';
		$data['link'] = 'http://evercise.com';
		$data['linkLabel'] = 'evercise.com';
		foreach($userList as $name => $email)
		{
			$emailBody = '
				<p>Hi '.$name.',</p>
				<br>
				<p>You’ve received a new message through Evercise from '.$trainer.', who is running the class '.$group.'.</p>
				<br>
				<p>Please see the message below:</p>
				<br>
				<p>'.$messageBody.'</p>
			';
			
			$data['body'] = $emailBody;
			$data['name'] = $name;
			$this->sendTo($email, $subject, $view, $data );
		}
	}

	// needs more descriptive name
	public function mailTrainer($trainer, $user, $group, $dateTime, $subject, $messageBody)
	{
		// ------ SEND EMAIL TO TRAINER ------
		foreach($trainer as $name => $email)
		{
			$emailBody = '
				<p>Hi '.$name.',</p>
				<br>
				<p>You’ve received a new message through Evercise from '.$user.', who will be taking part in your class '.$group.'.</p>
				<br>
				<p>Please see the message below:</p>
				<br>
				<p>'.$messageBody.'</p>
			';
			

			$subject = 'You have a new message.';
			$view = 'emails.template';
			$data['title'] = $subject;
			$data['mainHeader'] = 'You have a new message in your Evercise inbox.';
			$data['subHeader'] = 'A participant has contacted you.';
			$data['body'] = $emailBody;
			$data['link'] = 'http://evercise.com';
			$data['linkLabel'] = 'evercise.com';

			$data['name'] = $name;
			$this->sendTo($email, $subject, $view, $data );
		}
		
	}

	// used to mail user to confirm leaving a session

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

	public function refundRequest($email, $userName, $userEmail , $group, $messageSubject, $messageBody)
	{

		// ------ SEND EMAIL TO USER ACKNOWLEDGING THEIR REFUND REQUEST ------

		$emailBody = '
			<p>Hi '.$userName.',</p>
			<br>
			<p>We are sorry to hear that your recently attended class was not what you expected. We have received your request for a refund and our Customer Relations Manager is investigating your claim. We will do our best to get back to you within 5 working days..</p>
			<br>
			<p>Please note the following:</p>
			<ul>
				<li>Refund requests must be sent no more than 5 working days after you have taken part in the class concerned.</li>
				<li>You may only be refunded up to the amount of your original transaction.</li>
				<li>The refund will only be sent to the account associated with the original transaction.</li>
				<li>You must wait at least 24 hours after the original payment has been received before you can request a refund.</li>
				<li>Please allow 24-72 hours for refunds to be fully processed (the length of time is dependent on the payment gateway services and financial institutions involved in the transaction).</li>
			</ul>
			<br>
			<p>Feel free to call or email us with any questions. We’re always happy to help.</p>
			<br>
			<br>
			<p>Message:</p>
			<br>
			<p>'.$messageSubject.'</p>
			<br>
			<p>'.$messageBody.'</p>
		';
		

		$subject = 'Evercise refund request';
		$view = 'emails.template';
		$data['title'] = $subject;
		$data['mainHeader'] = 'You have a new message in your Evercise inbox.';
		$data['subHeader'] = 'Let`s try and resolve this';
		$data['body'] = $emailBody;
		$data['link'] = 'http://evercise.com';
		$data['linkLabel'] = 'evercise.com';

		$data['name'] = $name;
		$this->sendTo($email, $subject, $view, $data );
		$this->sendTo($userEmail, $subject, $view, $data );

	}

}