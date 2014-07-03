<?php namespace email;

use HTML;

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

		$body = '<span>Hi '.$display_name.' .</span>
				<br>
				<br>
				<span>You have just been connected with a network of great trainers and likeminded keep-fitters.</span>
				<br>
				<span>Evercise is an online network that gives everyone wanting to exercise access to fitness instructors and classes across London and soon the Uk.</span>';
		

		$subject = 'Welcome to Evercise';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = 'Welcome to Evercise';
		$data['mainHeader'] = 'Welcome to Evercise!';
		$data['subHeader'] = 'Thank you for joining our community.';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('home', 'evercise.com');
		$data['linkLabel'] = 'Start with evercise today:';
		$data['sellups'] = [ 0 => ['body' => 'Gain evercise credits to spend on classes by reommending your friends. for every 3 friend who join due to you referral you will recieve &pounds;3&apos;s of credit and each person who joined will recieve &pound;1 of credit aswell' , 'image' =>HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img'))] , 1 => ['body' => 'Jeff the trainer' , 'image' => HTML::image('img/Class.png','get fit', array('class' => 'home-step-img'))] ];

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




}