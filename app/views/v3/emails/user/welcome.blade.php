@extends('v3.emails.template')

object $user;

@section('body')



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
        $data['mainHeader'] = 'Welcome to Evercise, '.$user->display_name.'!';
        $data['subHeader'] = 'Why not join some classes right away?';
        $data['body'] = $body;
        $data['link'] = HTML::linkRoute('evercisegroups.search', 'Discover classes');
        $data['linkLabel'] = 'Search for classes near you:';
        //$data['sellups'] = [ 0 => ['body' => 'Gain evercise credits to spend on classes by reommending your friends. for every 3 friend who join due to you referral you will recieve &pounds;3&apos;s of credit and each person who joined will recieve &pound;1 of credit aswell' , 'image' =>HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img'))] , 1 => ['body' => 'Jeff the trainer' , 'image' => HTML::image('img/Class.png','get fit', array('class' => 'home-step-img'))] ];

        return $this->sendTo($email, $subject, $view, $data );

@stop