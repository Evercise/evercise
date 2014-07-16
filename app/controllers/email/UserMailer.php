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

		$events->listen('referral.invite', 'email\UserMailer@invite');
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

		$body = '
			<p>You now have access to a huge range of fitness classes and trainers operating at multiple locations!</p>
			<br>
			<p>Here are a few tips to get you started.</p>
			<br>
			<ul>
				<li><strong>Search fitness classes:</strong> Simply click “discover classes” on the navigation bar, then search by category or location.</li>
				<li><strong>Sign up to a class online:</strong> Click on the class panel and you will see a list of sessions. Choose the time and date you want, and pay for the class online.</li>
				<li><strong>Show up and shape up:</strong> Make sure you know where to go, at what time you should arrive, how to dress appropriately for the class and if you should bring anything e.g. water.</li>
				<li><strong>Rate and review:</strong> Once you have taken a class, help improve Evercise by rating the class and reviewing your experience.</li>
		';
		

		$subject = 'Welcome to Evercise';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = 'Welcome to Evercise';
		$data['mainHeader'] = 'Welcome to Evercise, '.$display_name.'!';
		$data['subHeader'] = 'Why not join some classes right away?';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('evercisegroups.search', 'Discover classes');
		$data['linkLabel'] = 'Search for classes near you:';
		//$data['sellups'] = [ 0 => ['body' => 'Gain evercise credits to spend on classes by reommending your friends. for every 3 friend who join due to you referral you will recieve &pounds;3&apos;s of credit and each person who joined will recieve &pound;1 of credit aswell' , 'image' =>HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img'))] , 1 => ['body' => 'Jeff the trainer' , 'image' => HTML::image('img/Class.png','get fit', array('class' => 'home-step-img'))] ];

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function welcome_fb($email, $display_name, $password)
	{
		$body = '
			<p>Here is your unique password: {{$password }} - you can change this at amy time</p>
			<p>You now have access to a huge range of fitness classes and trainers operating at multiple locations!</p>
			<br>
			<p>Here are a few tips to get you started.</p>
			<br>
			<ul>
				<li><strong>Search fitness classes:</strong> Simply click “discover classes” on the navigation bar, then search by category or location.</li>
				<li><strong>Sign up to a class online:</strong> Click on the class panel and you will see a list of sessions. Choose the time and date you want, and pay for the class online.</li>
				<li><strong>Show up and shape up:</strong> Make sure you know where to go, at what time you should arrive, how to dress appropriately for the class and if you should bring anything e.g. water.</li>
				<li><strong>Rate and review:</strong> Once you have taken a class, help improve Evercise by rating the class and reviewing your experience.</li>
		';
		

		$subject = 'Welcome to Evercise';
		$view = 'emails.template';
		$data['title'] = 'Welcome to Evercise';
		$data['mainHeader'] = 'Welcome to Evercise, '.$display_name.'!';
		$data['subHeader'] = 'Why not join some classes right away?';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('evercisegroups.search', 'Discover classes');
		$data['linkLabel'] = 'Search for classes near you:';

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


	public function invite($email, $referralCode, $referrerName)
	{
		$body = '<span>Hi.</span>
				<br>
				<br>
				<span>'.$referrerName.' has suggested that you join Evercise!</span>
				<br>
				<span>Evercise is an online network that gives everyone wanting to exercise access to fitness instructors and classes across London and soon the Uk.</span>
				<br>
				<span>By accepting this invitation, you will recieve 1 Evercoin, which can be used to help pay for classes!</span>';
		

		$subject = $referrerName.' Suggests Evercise';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = 'Introducing Evercise';
		$data['mainHeader'] = 'Introducing Evercise!';
		$data['subHeader'] = 'Your referral code: '.$referralCode;
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('referral', 'Click here to join Evercise', [$referralCode]);
		$data['linkLabel'] = 'Start with evercise today:';
		$data['sellups'] = [ 0 => ['body' => 'Gain evercise credits to spend on classes by reommending your friends. for every 3 friend who join due to you referral you will recieve &pounds;3&apos;s of credit and each person who joined will recieve &pound;1 of credit aswell' , 'image' =>HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img'))] , 1 => ['body' => 'Jeff the trainer' , 'image' => HTML::image('img/Class.png','get fit', array('class' => 'home-step-img'))] ];

		return $this->sendTo($email, $subject, $view, $data );
	}
}