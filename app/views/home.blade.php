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
								@include('layouts.classBlock', array( 'rating' => $ratings[$evercisegroup->id] / count($evercisegroup->ratings) , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
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

@stop