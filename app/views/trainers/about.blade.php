@extends('layouts.master')


@section('content')

	<div class="center_col">
		<h2>So you are looking at becoming a pro?</h2>
		<h2 class="grey">Great choice!</h2>
		<br>
		@if(!isset($status))
			{{ HTML::linkRoute('home', 'Set up your professional account!',null ,array('class' => 'btn btn-yellow', 'width' => '250px')) }}
		@else
			<p>To become a Evercise Professional you must first be logged in as a user.</p>
			<br>
			<p>Click the link below to signup.</p>
			<br>
			{{ HTML::linkRoute('users.create', 'Join Evercise today!',null ,array('class' => 'btn btn-yellow', 'width' => '250px')) }}
			<div class="orSeperator"><span>or alternatively</span></div>
			@if(isset($redirect_after_login))
				{{ HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , 'Log in',  array('id'=>'login', 'class' => 'login btn btn-yellow', 'width' => '250px')) }}
			@else
				{{ HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login')) }}
			@endif
		@endif
		<hr>
		<h2>What is Evercise to a fitness class instructor ?</h2>
		<h2 class="grey">Evercise brings you greater exposure !</h2>
		<br>
		<p>We offer a platform for health and fitness professionals to promote themselves,<br>
		their classes and their expertise to a large online community of potential participants. Create a professional profile viewable to the public,<br> add classes which will be linked to your profile and can be searched for and purchased online,<br> 
		gain trust through our rating system.<br> 
		Whether you want to generate interest in a new class you are trying out, or increase the number of participants at classes you teach already,<br> 
		Evercise is the place to be.</p>
		<hr>

		{{ HTML::image('img/go_pro_icons.png','what is evercise', array('class' => 'center-img')) }}
		
		<h2>What is an Evercise Instructor ?</h2>
		<h2 class="grey">Anyone who offers a professional group fitness service.</h2>
		<br>
		<p>You can be an Evercise Instructor if you are a qualified professional who runs or is looking to run group fitness classes in and around London. <br>
		We consider varying levels of expertise, class types and locations. <br>
		Potential participants can search through a wide range of instructors and classes on one website, <br>
		making Evercise highly appealing to the public and a great place for your online presence.</p>
		<hr>

		{{ HTML::image('img/why_join.png','why join evercise as a profesional trainer', array('class' => 'center-img')) }}
		
		<h2>Why should you join Evercise?</h2>
		<h2 class="grey">In short, you can't lose, you can only win!</h2>
		<br>
		<p>Evercise provides access to a large targeted audience. <br>
		You become part of a keep-fit community, within which you can promote yourself for free, <br>
		gain exposure and boost the number of participants in your classes. <br>
		Evercise is also a great online base of operations in terms of organisation.</p>
		<p>
			<ul>
				<li>Set up classes at the click of a button (these classes will be automatically promoted)</li>	
				<li>Manage payments through Evercise</li>
				<li>Download participant lists</li>
				<li>Evercise's events calendar sends out handy reminders to both you and your participants before a class.</li>
			</ul>
		</p>
		<p>You don’t have to pay a penny until you start earning, and when you do, <br>
		we offer a generous reward system so that the more you earn, <br>
		the smaller the rate of commission!</p>
		<hr>

		{{ HTML::image('img/reputation_small.png','gain a reputation on evercise', array('class' => 'center-img')) }}

		<h2>What makes Evercise different?</h2>
		<h2 class="grey">Evercise is not just another profile site.</h2>
		<br>
		<p>It is an ever expanding community of potential participants. <br>
		Due to busy, bustling, London lifestyles, it can be difficult to get individuals to commit to an entire course. <br>
		Through Evercise, participants can sign up on a class-by-class basis, <br>
		meaning all those wanting to get fit with maximum flexibility will come to Evercise first.</p>
	</div>


@stop