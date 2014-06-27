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
	}


	public function remind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail)
	{
		$data['group'] = $group;
		$data['location'] = $location;
		$data['dateTime'] = $dateTime;
		$data['trainerName'] = $trainerName;
		$data['trainerEmail'] = $trainerEmail;

		foreach($userList as $name => $email)
		{
			$data['name'] = $name;
			$this->sendTo(
				$email,
				'You have an Evercise session coming up',
				'emails.session.remind',
				$data
			);
		}

		$data['userList'] = $userList;

		$this->sendTo(
			$trainerEmail,
			'List of members for your upcoming '.$group.' session',
			'emails.session.userList',
			$data
		);
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




}