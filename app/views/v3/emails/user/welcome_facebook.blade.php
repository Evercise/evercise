@extends('v3.emails.template')

object $user, $link


Since people who login with facebook dont set passwords.
We can give them a option in the email. they just have to click the {{ $link }}
@section('body')



       $$body = '
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

@stop