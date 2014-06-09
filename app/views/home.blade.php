@extends('layouts.master')

@section('banner')
	<div id="homepage-banner" class="banner"></div>

@stop

@section('content' )
	
	<div class="full-width">
		<div class="step_wrapper">
			<h1>Get fit with Evercise in three simple steps:</h1>

			<div id="step_1" class="home_step one_t">
				{{ HTML::image('img/search_classes.png','search for classes', array('class' => 'home-step-img')) }}
				<h5>1</h5>
				<h5>Search fitness<br> classes</h5>
			</div>
			<div id="step_2" class="home_step one_t">
				{{ HTML::image('img/join_up.png','join up', array('class' => 'home-step-img')) }}
				<h5>2</h5>
				<h5>Sign up to a<br> class online</h5>
			</div>
			<div id="step_3" class="home_step one_t">
				{{ HTML::image('img/get_fit.png','get fit', array('class' => 'home-step-img')) }}
				<h5>3</h5>
				<h5>Show up and<br> shape up!</h5>
			</div>
			<div class="search-box">
				{{ Form::open(array('id' => 'search-by-location', 'url' => 'evercisegroups/search/'.Str::quickRandom(5), 'method' => 'get', 'class' => 'search-form')) }}
					{{ Form::text( 'location' , null, array('placeholder' => 'Search by location (town or postcode)', 'maxlength' => 50)) }}
					{{ Form::select( 'category' , $types ) }}
					{{ Form::select( 'radius' , $radiuses ) }}
					{{ Form::submit('Search classes' , array('class'=>'btn btn-darkyellow ')) }}
				{{ Form::close() }}
			</div>
		</div>

		<div class="home-body">
			<div class="video-wrapper">
				<h2>See how Evercise works</h2>
				{{--
				<video id="video" class="video" controls>
					<source src="/video/test.mp4"  type="video/mp4" />
					<object width="640" height="360" type="application/x-shockwave-flash" data="__FLASH__.SWF">
						<param name="movie" value="http://av.vimeo.com/60498/754/117050714.mp4?token2=1401976555_2f596ea36db988562ab21f1dad7ca6de&amp;aksessionid=10381e8092c8664c" />
						<param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
						<img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
						     title="No video playback capabilities, please download the video below" />
					</object>
				</video>
				--}}
			</div>
			<div class="sign-up-wrapper">
				<h2>Join Evercise today</h2>
				<h5>And gain access to a range of fitness classes</h5>
				<h6>Sign up using your facebook account</h6>
				{{ HTML::link('login/fb', 'Sign up with facebook', array('class' => 'btn-fb')) }}
				<hr>
				<h6>Or click the link below to signup using our signup form</h6>
				{{ HTML::link('users/create', 'Join Evercise today', array('class' => 'btn-yellow')) }}
				<hr>
				<h5>I&#039;m A Trainer</h5>
				<h6>If you are a trainer and are wanting to join evercise as a trainer please click here</h6>
				{{ HTML::linkRoute('trainers.create', 'I&#039;m a trainer', null , array('class' => 'btn-darkyellow')) }}
			</div>
			
		</div>



	</div>

	

	
	

@stop