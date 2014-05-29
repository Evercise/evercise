@extends('layouts.master')
<?php $activation = isset($activation) ? $activation : Session::get('activation') ?>

@section('content')
<div class="row10 push1">
	<div class="col7">
	<br>
	<br>
	{{$activation = 3}}
		<h2>Hi {{ $display_name }}</h2>
		<br>
		@if(!isset($activation))
			<h4>Thank you for joining Evercise :-)</h4>
			<br>
			<p>You should have received an e-mail from us with a link that you will need to click in order to verify your account. (If you can&apos;t see the e-mail, remember to check your junk folder.) As soon as you have done this, you can browse and purchase group fitness classes on Evercise!</p>
			<p>In the mean time click the link below to continue with evercise</p>
			<div class="row3" >
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
				<h4>Seriously dude, you have been sent an activation code.</h4>
				<br>
				<p>Click it</p>
			@elseif($activation == 2)
				<h4>Congratulations</h4>
				<br>
				<p>Your account has been successfuly activated</p>
			@elseif($activation == 3)
				<h4>Congratulations</h4>
				<br>
				<p>you have successfully signed up with facebook.</p> 
				<p>Your password has been emailed to you</p>
				<br>
				<br>
				<br>
				<br>
				<br>
    			@include('users.edit_form', array())
			@endif

			@if($activation >= 2)
			<br>
				<div class="row3" >
					<br>
					<br>
					{{ HTML::linkRoute('home', 'Check out some classes',null ,array('class' => 'btn-yellow')) }}
				</div>
				<div class="row3" >
					<br>
					<br>
					{{ HTML::linkRoute('trainers.create', 'Become a Trainer',null ,array('class' => 'btn-yellow')) }}
				</div>
			@endif
		@endif
	</div>
	<div class="col3">
		{{ HTML::image('img/confussed_guy.png','sign up potatoe guy', array('class' => 'side-img')) }}
	</div>
</div>
@stop