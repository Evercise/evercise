@extends('layouts.fullWidthMaster')

@section('content' )

<div id="homepage-banner" class="banner"></div>

<div class="container-full">
	<div class="video-placeholder">
		
		{{ HTML::image('img/play-vid.png','play video', array('class' => 'play-button')) }}

		<video id="video" class="video" controls>
			<source src="/video/evercise944.mov"  type="video/mp4" />
		</video>
	</div>
</div>


<div class="home-body">
	<div class="search-box">
		<div class="container-full">
			<div class="search-box-wrap">
				<h4>Search for a class or instructor near you</h4>
				@include('evercisegroups.refine')
			</div>
			
		</div>
	</div>
	<div class="step_wrapper">
		<div class="container-full">
			<h4>Get fit with Evercise in four simple steps:</h4>
			<hr>

			<div id="step_1" class="four-step">
				{{ HTML::image('img/search.png','search for classes', array('class' => 'home-step-img')) }}
				<h6>Search fitness classes</h6>
			</div>
			<div id="step_2" class="four-step">
				{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
				<h6>Sign up to a class online</h6>
			</div>
			<div id="step_3" class="four-step">
				{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
				<h6>Show up and shape up!</h6>
			</div>
			<div id="step_4" class="four-step">
				{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
				<h6>Rate and review</h6>
			</div>
		</div>
		
	</div>
	<div class="featured_wrapper">
		<div class="container-full">
			<h3>Featured Classes</h3>
				<div class='featured-wrap'>
					@foreach ($evercisegroups as $key => $evercisegroup)	
						<div class="col3">
							@if (count($evercisegroup->ratings) == 0) 
								@include('layouts.classBlock', array( 'rating' => 0 , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
							@else
								@include('layouts.classBlock', array( 'rating' => $ratings[$key] / count($evercisegroup->ratings) , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
							@endif
						</div>	
								
					@endforeach
				</div>
				
		</div>
	</div>
	<div class="join_wrapper">
		<div class="container-full">
			<h4>Join the Evecise community today and find your way<br> to a happier, fitter you...</h4>
			{{HTML::link('users/create', 'Register', array('class' => 'btn btn-yellow'))}}
			{{ HTML::image('img/WIE_4.jpg','join us ', array('class' => 'register-img')) }}
		</div>
	</div>
</div>
	{{--<div class="video-wrapper">
		<h2>See how Evercise works</h2>
		
		<video id="video" class="video" controls>
			<source src="/video/test.mp4"  type="video/mp4" />
			<object width="640" height="360" type="application/x-shockwave-flash" data="__FLASH__.SWF">
				<param name="movie" value="http://av.vimeo.com/60498/754/117050714.mp4?token2=1401976555_2f596ea36db988562ab21f1dad7ca6de&amp;aksessionid=10381e8092c8664c" />
				<param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
				<img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
				     title="No video playback capabilities, please download the video below" />
			</object>
		</video>
		
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
	--}}
	


	

	
	

@stop