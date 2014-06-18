@extends('layouts.master')

@section('content')

	
	@include('trainers.trainerBlock', array('orientation' => 'landscape', 'image' => '/profiles/'.  $userTrainer->directory.'/'. $userTrainer->image , 'name' => $userTrainer->display_name , 'member_since' => date('dS M-Y', strtotime( $userTrainer->created_at))))
	<div class="col8 push2">
		<br>
		<br>
		<h5>{{$userTrainer->display_name}}&apos;s classes </h5>
		<br>
		<br>
		@foreach ($evercisegroups as $key => $evercisegroup)


			<div class="col3">
				@if (isset($stars[$evercisegroup->id]))
					@include('layouts.classBlock', array( 'rating' => array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]),'lat'=> $evercisegroup->venue->lat, 'lng' => $evercisegroup->venue->lng,  'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$userTrainer->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
				@else
					@include('layouts.classBlock', array( 'rating' => 0,'lat'=> $evercisegroup->venue->lat, 'lng' => $evercisegroup->venue->lng ,  'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$userTrainer->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
				@endif
			</div>

		@endforeach

		<div class="rating-wrap">
		<br>
		<br>
		<h5>{{$userTrainer->display_name}}&apos;s Ratings </h5>
		<br>
		<br>
		@foreach ($ratings as $key => $rating) 
			<div class="rating-row col10">
				<div class="rating-block">
					{{ HTML::image('profiles/'.$rating->user->directory.'/'.$rating->user->image,  $rating->user->display_name  , array('title' => $rating->user->display_name ,'class' => 'user-icon')) }}
					{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}


					<span>
					<div class="star_wrap">
						@include('ratings.stars', array('rating' => $rating->stars ))
					</div>
					


					<strong>  {{ $rating->user->display_name }}</strong> on {{ date('d/m/Y' , strtotime($rating->created_at))}} </span>
					<p>{{ $rating->comment}}</p> 
				</div>
			</div>
			
		@endforeach
		@foreach ($ratings as $key => $rating) 
			<div class="rating-row col10">
				<div class="rating-block">
					{{ HTML::image('profiles/'.$rating->user->directory.'/'.$rating->user->image,  $rating->user->display_name  , array('title' => $rating->user->display_name ,'class' => 'user-icon')) }}
					{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}


					<span>
					<div class="star_wrap">
						@include('ratings.stars', array('rating' => $rating->stars ))
					</div>
					


					<strong>  {{ $rating->user->display_name }}</strong> on {{ date('d/m/Y' , strtotime($rating->created_at))}} </span>
					<p>{{ $rating->comment}}</p> 
				</div>
			</div>
			
		@endforeach
		</div>
	</div>
@stop


