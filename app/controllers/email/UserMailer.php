<?php namespace email;

class UserMailer extends Mailer {

	/**
	 * Outline all the events this class will be listening for. 
	 * @param  [type] $events 
	 * @return void         
	 */
	public function subscribe($events)
	{
		$events->listen('user.signup', 		'email\UserMailer@welcome');
		$events->listen('user.fb_signup', 		'email\UserMailer@welcome_fb');
		$events->listen('user.resend', 		'email\UserMailer@welcome');
		$events->listen('user.forgot',      'email\UserMailer@forgotPassword');
		$events->listen('user.newpassword', 'email\UserMailer@newPassword');
		$events->listen('user.upgrade', 'email\UserMailer@upgrade');
		$events->listen('session.mail_all', 'email\UserMailer@mailAll');
		$events->listen('session.mail_trainer', 'email\UserMailer@mailTrainer');
	}

	/**
	 * Send a welcome email to a new user.
	 * @param  string $email          
	 * @param  int    $userId         
	 * @param  string $activationCode 		
	 * @return bool
	 */


	public function welcome($email, $display_name, $activation_code)
	{
		$subject = 'Welcome to Evercise';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.user.welcome';
		$data['display_name'] = $display_name;
		$data['activation_code'] = $activation_code;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function welcome_fb($email, $display_name, $password)
	{
		$subject = 'Welcome to Evercise';
		$view = 'emails.auth.fb_welcome';
		$data['display_name'] = $display_name;
		$data['generated_password'] = $password;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
	}

	/**
	 * Email Password Reset info to a user.
	 * @param  string $email          
	 * @param  int    $userId         
	 * @param  string $resetCode 		
	 * @return bool
	 */
	public function forgotPassword($email, $displayName, $resetCode)
	{
		$subject = 'Password Reset Confirmation | Laravel4 With Sentry';
		$view = 'emails.auth.reset';
		$data['displayName'] = $displayName;
		$data['resetCode'] = $resetCode;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
	}

	/**
	 * Email New Password info to user.
	 * @param  string $email          
	 * @param  int    $userId         
	 * @param  string $resetCode 		
	 * @return bool
	 */
	public function newPassword($email, $newPassword)
	{
		$subject = 'New Password Information | Laravel4 With Sentry';
		$view = 'emails.auth.newpassword';
		$data['newPassword'] = $newPassword;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function upgrade($email, $display_name)
	{
		$subject = 'Welcome to Evercise';
		$view = 'emails.user.upgrade';
		$data['display_name'] = $display_name;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
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



}