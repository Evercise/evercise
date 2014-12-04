@extends('v3.emails.template')

object $user


@section('body')



      Trainer Welcome Email


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



@stop