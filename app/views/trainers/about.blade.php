@extends('layouts.master')


@section('content')

	<div class="center_col">
		<h2>{{trans('trainers-about.section1-title')}}</h2>
		<h2 class="grey">{{trans('trainers-about.section1-subtitle')}}</h2>
		<br>
		@if(!isset($status))
			{{ HTML::linkRoute('home', 'Set up your professional account!',null ,array('class' => 'btn btn-yellow', 'width' => '250px')) }}
		@else
			{{trans('trainers-about.section1-body')}}
			<br>
			{{ HTML::linkRoute('trainers.trainerSignup', 'Join Evercise today!',null ,array('class' => 'btn btn-yellow', 'width' => '250px')) }}
		@endif
		<hr>
		
		<h2>{{trans('trainers-about.section2-title')}}</h2>
		<h2 class="grey">{{trans('trainers-about.section2-subtitle')}}</h2>
		<br>
		{{trans('trainers-about.section2-body')}}
		<hr>

		{{ HTML::image(trans('trainers-about.section3-image_url'), trans('trainers-about.section3-image_alt'), array('class' => 'center-img')) }}
		<h2>{{trans('trainers-about.section3-title')}}</h2>
		<h2 class="grey">{{trans('trainers-about.section3-subtitle')}}</h2>
		<br>
		{{trans('trainers-about.section3-body')}}
		<hr>

		{{ HTML::image(trans('trainers-about.section4-image_url'), trans('trainers-about.section4-image_alt'), array('class' => 'center-img')) }}
		<h2>{{trans('trainers-about.section4-title')}}</h2>
		<h2 class="grey">{{trans('trainers-about.section4-subtitle')}}</h2>
		<br>
		{{trans('trainers-about.section4-body')}}
		<hr>

		{{ HTML::image(trans('trainers-about.section5-image_url'), trans('trainers-about.section5-image_alt'), array('class' => 'center-img')) }}
		<h2>{{trans('trainers-about.section5-title')}}</h2>
		<h2 class="grey">{{trans('trainers-about.section5-subtitle')}}</h2>
		<br>
		{{trans('trainers-about.section5-body')}}
		

	</div>


@stop