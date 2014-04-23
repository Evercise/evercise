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
		$view = 'emails.auth.welcome';
		$data['display_name'] = $display_name;
		$data['activation_code'] = $activation_code;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function welcome_fb($email, $display_name, $password)
	{
		$subject = 'Welcome to Evercise';
		$view = 'emails.auth.welcome';
		$data['display_name'] = $display_name;
		$data['activation_code'] = $password;
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



}