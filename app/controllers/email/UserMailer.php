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
		$events->listen('user.confirm', 'email\UserMailer@trainer_confirm');
		$events->listen('referral.invite', 'email\UserMailer@invite');
		$events->listen('landing.ppc', 'email\UserMailer@ppc');
	}

	/**
	 * Send a welcome email to a new user.
	 * @param  string $email          
	 * @param  int    $userId         
	 * @param  string $activationCode 		
	 * @return bool
	 */


	public function welcome($email, $display_name)
	{

		$body = '
			<p>You now have access to a huge range of fitness classes and trainers operating at multiple locations!</p>
			<br>
			<p>Here are a few tips to get you started.</p>
			<br>
			<p>
				<li><strong>Search fitness classes:</strong> Simply click “discover classes” on the navigation bar, then search by category or location.</li>
				<li><strong>Sign up to a class online:</strong> Click on the class panel and you will see a list of sessions. Choose the time and date you want, and pay for the class online.</li>
				<li><strong>Show up and shape up:</strong> Make sure you know where to go, at what time you should arrive, how to dress appropriately for the class and if you should bring anything e.g. water.</li>
				<li><strong>Rate and review:</strong> Once you have taken a class, help improve Evercise by rating the class and reviewing your experience.</li>
			</p>
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
			<p>Here is your unique password: '.$password .' - you can change this at amy time</p>
			<p>You now have access to a huge range of fitness classes and trainers operating at multiple locations!</p>
			<br>
			<p>Here are a few tips to get you started.</p>
			<br>
			<p>
				<li><strong>Search fitness classes:</strong> Simply click “discover classes” on the navigation bar, then search by category or location.</li>
				<li><strong>Sign up to a class online:</strong> Click on the class panel and you will see a list of sessions. Choose the time and date you want, and pay for the class online.</li>
				<li><strong>Show up and shape up:</strong> Make sure you know where to go, at what time you should arrive, how to dress appropriately for the class and if you should bring anything e.g. water.</li>
				<li><strong>Rate and review:</strong> Once you have taken a class, help improve Evercise by rating the class and reviewing your experience.</li>
			</p>
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
		/*$subject = 'Password Reset Confirmation | Laravel4 With Sentry';
		$view = 'emails.auth.reset';
		$data['displayName'] = $displayName;
		$data['resetCode'] = $resetCode;
		$data['email'] = $email;
	*/
		$body = '
			<p>Hi '.$displayName.'</p>
			<p>Simply click the link below.</p>
		';
		

		$subject = 'Your Evercise password';
		$view = 'emails.template';
		$data['title'] = 'Your Evercise password';
		$data['mainHeader'] = 'Password escaped you?';
		$data['subHeader'] = 'No worries, it happens! Here&apos;s how to reset it.';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('users.resetpassword' , 'Reset', [$displayName,urlencode($resetCode) ]);
		$data['linkLabel'] = 'click to reset password:';

		return $this->sendTo($email, $subject, $view, $data );
	}

	/**
	 * Email New Password info to user.
	 * @param  string $email          
	 * @param  int    $userId         
	 * @param  string $resetCode 		
	 * @return bool
	 */
	public function newPassword($email)
	{
		/*
		$subject = 'New Password Information | Laravel4 With Sentry';
		$view = 'emails.auth.newpassword';
		$data['newPassword'] = $newPassword;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data );
		*/

		$body = '
			<p>Hi again</p>
			<p>You can now log in to Evercise using your new password.</p>
		';

		$subject = 'Evercise password reset confirmation';
		$view = 'emails.template';
		$data['title'] = 'Evercise password reset confirmation';
		$data['mainHeader'] = 'Sorted!';
		$data['subHeader'] = 'You have successfully reset your password.';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('home', 'Click here to login in to Evercise');
		$data['linkLabel'] = 'Login to evercise:';

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function upgrade($email, $display_name)
	{
		$body = '
			<p>Here are a few tips to get you started.</p>
			<p>
				<li><strong>Create classes: </strong> : Simply click “class hub” on the navigation bar, then “create a new class”. Add all the class details and a photo to represent it. Choose a category so your class is easily searchable. Add your venues, which will appear in a drop down menu the next time you create a class.</li>
				<li><strong>Manage classes online:</strong> View participant lists and easily contact those who have joined. You can delete a class up until it has its first participant. View class statistics onthe class hub page, so that you can monitor the progress and success of a class.
				</li>
				<li><strong>Run classes at your chosen location: </strong>Make sure all of your participants know where to go, at what time they should arrive, how to dress appropriately for the class and if they should bring anything e.g. water
				</li>
				<li><strong>Get Rated:</strong>Be sure to ask participants to rate you after a class so that you can build a reputation and gain trust within the Evercise community!
				</li>
			</p>
		';
		

		$subject = 'Welcome! Start selling classes on Evercise.';
		$view = 'emails.template';
		$data['title'] = 'Welcome! Start selling classes on Evercise.';
		$data['mainHeader'] = 'Congratulations, '.$display_name.', you are now an Evercise trainer!';
		$data['subHeader'] = 'Why not join some classes right away?';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('home', 'evercise');
		$data['linkLabel'] = 'Start creating classes:';

		return $this->sendTo($email, $subject, $view, $data );
	}

	public function trainer_confirm($email, $display_name)
	{
        $this->trainer_admin_notification($email, $display_name);

		$body = '
			<p>Hi '.$display_name.'</p>
			<p>We are delighted you have decided to become an Evercise trainer! You can start creating classes straight away, but these will only become visible to the public once your application has been processed. This should take no longer than 48 hours.
			</p>
			<p>
				Thanks for your patience
			</p>
		';
		

		$subject = 'Evercise trainer verification';
		$view = 'emails.template';
		$data['title'] = 'Evercise trainer verification';
		$data['mainHeader'] = 'Great to have you on board!';
		$data['subHeader'] = 'Your application is being processed';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('home', 'evercise');
		$data['linkLabel'] = 'Start creating classes:';

		return $this->sendTo($email, $subject, $view, $data );
	}

    /**
     * Send a notification email to the admin email address set in config.
     *
     * @param $email
     * @param $display_name
     */
    public function trainer_admin_notification($email, $display_name)
    {
        $body = '
			<p>Hi</p>
			<p>A new trainer has signed up, please verify the account</p>
			<p>Email: '.$email.'</p>
			<p>Display Name: '.$display_name.'</p>
		';


        $subject = 'Evercise trainer verification';
        $view = 'emails.template';
        $data['title'] = 'Evercise trainer verification';
        $data['mainHeader'] = 'A new trainer is awaiting verification';
        $data['subHeader'] = 'You will need to be logged in with an admin account';
        $data['body'] = $body;
        $data['link'] = HTML::linkRoute('admin.pendingtrainers', 'Pending Trainers');
        $data['linkLabel'] = 'Verify the new trainer here:';

        return $this->sendTo(getenv('EMAIL_ADMIN'), $subject, $view, $data );
    }



	public function invite($email, $referralCode, $referrerName)
	{
		$body = '
		<p>Hi There</p>
				
		<p>
		May we introduce you to Evercise? We offer the perfect solution for those wanting to keep fit with maximum flexibility. It&apos;s simple:
		</p>

		<p>
			<li>Search a huge range of fitness classes by type or location</li>
			<li>Purchase classes online (you can do this on a class by class basis)</li>
			<li>Show up and shape up</li>
			<li>Rate and review</li>
		</p>
		<p>
			On Evercise.com you can search for your favourite workout at a time and location that suits	you. Fit your training around your job or studies, find trainers with the best reviews, and keep fit without having to commit a thing
		</p>
		<p>
			Does this sound interesting to you? Then what are you waiting for? It&apos;s completely free to join!
		</p>
		';
		

		$subject = $referrerName.' thinks you should join Evercise!';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = $referrerName.' thinks you should join Evercise!';
		$data['mainHeader'] = 'Have you heard of Evercise?';
		$data['subHeader'] = 'Your friend '.$referrerName.' thinks you would love it!';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('referral', 'Click here to join Evercise', [$referralCode]);
		$data['linkLabel'] = 'Start with evercise today:';
		
		return $this->sendTo($email, $subject, $view, $data );
	}

	public function ppc($email, $categoryId, $ppcCode)
	{


		$body = '
		<h5>You can also get an extra 500 Evercoins (&pound;5) by referring three of your friends!</h5>
				
		<p>
			You&apos;re moments away from claiming your 300 Evercoins (&pound;3)*! Now here are ways to gain more... Not only do you have access to a wide range of fitness classes and trainers, but you can spend your Evercoins as you wish on many different classes on the platform! 
		</p>

		<p>
			And that&apos;s not it. You can gain up to &pound;5*, (a credit of 500 Evercoins) by referring your friends! All you have to do is get them to register with a valid email address on evercise.com or they can sign up using their Facebook account. It&apos;s really that simple.
		</p>
		<p>
			'.\Config::get('values.ppc_category_examples')[$categoryId].'
		</p>
		<p>
			We aim to make your Evercise experience rewarding and worthwhile, so why not take the step now!
		</p>
		';

		$category = \Category::find($categoryId)->pluck('name');
		

		$subject = 'Pay as you go fitness!';
		//$view = 'emails.auth.welcome'; // use for validation email
		$view = 'emails.template';
		$data['title'] = $subject;
		$data['mainHeader'] = 'Pay as you go fitness!';
		$data['subHeader'] = 'Sign up with the link below to recieve your 300 Evercoins (&pound;3)';
		$data['body'] = $body;
		$data['link'] = HTML::linkRoute('landing.category.code', 'Start with evercise today: ', [$category, $ppcCode]);
		$data['linkLabel'] = 'Start with evercise today:';
		
		return $this->sendTo($email, $subject, $view, $data );
	}

}
