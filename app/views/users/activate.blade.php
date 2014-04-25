@extends('layouts.master')


@section('content')

<div class="large_left">
<br>
<br>
	<h2>Hi {{ $display_name }}</h2>
	<br>
	@if(!isset($activation))
		<h4>Thanks for signing up.</h4>
		<br>
		<p>You should recieve a email to verify your details, please follow the instructions in the email.</p>
		<p>In the mean time click the link below to continue with evercise</p>
		<div class="btn-wrapper" >
			<br>
			<br>
			{{ HTML::linkRoute('home', 'Home',null ,array('class' => 'btn-yellow')) }}
		</div>
	@else
		@if($activation == 0)
			<h4>Your account could not be activated</h4>
			<br>
			<p>if you copied and pasted the URL, please check you didn&apos;t miss any characters</p>
		@elseif($activation == 1)
			<h4>Congratulations</h4>
			<br>
			<p>Your account has been successfuly activated</p>
		@elseif($activation == 2)
			<h4>Congratulations</h4>
			<br>
			<p>you have successfully signed up with facebook.</p> 
			<p>Your password has been emailed to you</p>
		@endif

		@if($activation >= 1)
		<br>
			<div class="btn-wrapper" >
				<br>
				<br>
				{{ HTML::linkRoute('home', 'Check out some classes',null ,array('class' => 'btn-yellow')) }}
			</div>
			<div class="btn-wrapper" >
				<br>
				<br>
				{{ HTML::linkRoute('home', 'Become a Trainer',null ,array('class' => 'btn-yellow')) }}
			</div>
		@endif
	@endif
</div>
<div class="small_right">
	{{ HTML::image('img/confussed_guy.png','sign up potatoe guy', array('class' => 'side-img')) }}
</div>

@stop