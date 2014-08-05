@extends('layouts.fullWidthMaster')
<?php View::share('title', Loc::text('general', 'title')) ?> 
<?php View::share('metaDescription', Loc::text('general', 'meta_description')) ?>
@section('top' )

<div class="row">
	<div class="col12 tc">
		<h1 class="mt20">{{Loc::text($view_name, 'main_header')}}</h1>
		<h3>{{Loc::text($view_name, 'sub_header')}}</h3>
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
		<h4>{{Loc::text($view_name, 'three_steps')}}</h4>
		<hr>
			

		<div id="step_1" class="four-step col4">
			{{ HTML::image('img/search.png','search for classes', array('class' => 'home-step-img')) }}
			<h6>{{Loc::text('general', 'step_1')}}</h6>
		</div>
		<div id="step_2" class="four-step col4">
			{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
			<h6>{{Loc::text('general', 'step_2')}}</h6>
		</div>
		<div id="step_3" class="four-step col4">
			{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
			<h6>{{Loc::text('general', 'step_3')}}</h6>
		</div>

		
	</div>
	<hr>
	<div class="featured_wrapper">
		<h3>{{Loc::text($view_name, 'featured_classes')}}</h3>
		<div class='featured-wrap'>
			@foreach ($evercisegroups as $key => $evercisegroup)	
				<div class="col3">
					@include('layouts.classBlock', array( 'rating' => count($evercisegroup->ratings) == 0 ? 0 : $ratings[$evercisegroup->id] / count($evercisegroup->ratings)  , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name ,   'venue' => $evercisegroup->venue  ,'sessions' => $evercisegroup->futuresessions, 'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price ))
				</div>	
						
			@endforeach
		</div>
				
	</div>
	@if(!isset($user))
		<hr>
		<div class="join_wrapper">
			<h4>{{Loc::text($view_name, 'register_text')}}</h4>
			{{HTML::link('users/create', Loc::text('general', 'register', true), array('class' => 'btn btn-yellow btn-large'))}}
			{{ HTML::image('img/potato men group fitness.png','join us ', array('class' => 'register-img')) }}
		</div>
	@endif
</section>

@stop