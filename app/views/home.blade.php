@extends('layouts.fullWidthMaster')
<?php View::share('title', 'Exercise for Everyone Everywhere') ?> 
<?php View::share('metaDescription', 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.') ?>
@section('top' )

<div class="row">
	<div class="col12 tc">
		<h1 class="mt20">Lower your barrier to enjoy fitness classes</h1>
		<h3>Flexible schedule and multiple options across London.</h3>
		<div class="video-placeholder mb20">
			
			{{ HTML::decode(HTML::linkRoute('video', '<img src="'.url().'/img/play-vid.png"></img>', null , array('class'=>'play-button')) ) }}

			
		</div>

		<div class="search-box mb40">
			<div class="search-box-wrap">
				@include('evercisegroups.refine', ['loadAutocompleteScript'=>1])
			</div>
	</div>
	</div>
</div>

@stop

@section('content' )
<section class="home-body row">
	<div class="step_wrapper">
		<h4>Get fit with Evercise in four simple steps:</h4>
		<hr>

		<div id="step_1" class="four-step col4">
			{{ HTML::image('img/search.png','search for classes', array('class' => 'home-step-img')) }}
			<h6>Search fitness classes</h6>
		</div>
		<div id="step_2" class="four-step col4">
			{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
			<h6>Sign up to a class online</h6>
		</div>
		<div id="step_3" class="four-step col4">
			{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
			<h6>Show up and shape up!</h6>
		</div>

		
	</div>
	<hr>
	<div class="featured_wrapper">
		<h3>Featured Classes</h3>
		<div class='featured-wrap'>
			@foreach ($evercisegroups as $key => $evercisegroup)	
				<div class="col3">
					@include('layouts.classBlock', array( 'rating' => count($evercisegroup->ratings) == 0 ? 0 : $ratings[$evercisegroup->id] / count($evercisegroup->ratings)  , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name ,   'venue' => $evercisegroup->venue  ,'sessions' => $evercisegroup->futuresessions, 'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price ))
				</div>	
						
			@endforeach
		</div>
				
	</div>
	<hr>
	<div class="join_wrapper">
		<h4>Join the Evecise community today and find<br>your way to a happier, fitter you...</h4>
		{{HTML::link('users/create', 'Register', array('class' => 'btn btn-yellow btn-large'))}}
		{{ HTML::image('img/potato men group fitness.png','join us ', array('class' => 'register-img')) }}
	</div>
</section>

@stop