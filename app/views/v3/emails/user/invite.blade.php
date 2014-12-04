 @extends('v3.emails.template')

  $email, $referralCode, $referrerName


 @section('body')


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

 @stop
