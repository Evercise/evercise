 @extends('v3.emails.template')

$email, $categoryId, $ppcCode


 @section('body')

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

 @stop
