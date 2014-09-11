@extends('layouts.master')

@section('content')

	
	@if(count($user_trainer->ratings) == 0 )
		@include('trainers.trainerBlock', array('speciality' => $user_trainer->trainer->profession , 'orientation' => 'landscape', 'image' => '/profiles/'.  $user_trainer->directory.'/'. $user_trainer->image , 'name' => $user_trainer->display_name , 'trainerRating' => 0 ,'member_since' => date('dS M-Y', strtotime( $user_trainer->trainer->created_at))))

	@else
		@include('trainers.trainerBlock', array('speciality' => $user_trainer->trainer->profession , 'orientation' => 'landscape', 'image' => '/profiles/'.  $user_trainer->directory.'/'. $user_trainer->image , 'name' => $user_trainer->display_name , 'trainerRating' => $totalStars / count($user_trainer->ratings) ,'member_since' => date('dS M-Y', strtotime( $user_trainer->trainer->created_at))))

	@endif

		<div class="col10 push2">
		<br>
		<br>
		<h5>{{$user_trainer->display_name}}&apos;s classes </h5>
		<br>
		<br>
		@foreach ($evercisegroups as $key => $evercisegroup)


			<div class="col3">
				@include('layouts.classBlock',[
				'rating' => isset($evercisegroup->ratings)?  array_sum((array)$evercisegroup->ratings)/ count($evercisegroup->ratings) : 0 ,
				  'evercisegroupId' => $evercisegroup->id,
				  'title' => $evercisegroup->name ,
				  'description' =>$evercisegroup->description ,
				  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,
				  'venue' => $evercisegroup->venue  ,
				  'sessions' => $evercisegroup->futuresessions,
				  'default_price' => $evercisegroup->default_price,
				  'default_size' => $evercisegroup->capacity
				  ]
				)

			</div>

		@endforeach

		<div class="rating-wrap">
		<br>
		<br>
		<h5>{{$user_trainer->display_name}}&apos;s Ratings </h5>
		<br>
		<br>

		@foreach ($user_trainer->ratings as $key => $rating)
			<div class="rating-row col10">
				<div class="rating-block">
					{{ HTML::image('profiles/'.$rating->rator->directory.'/'.$rating->rator->image,  $rating->rator->display_name  , array('title' => $rating->rator->display_name ,'class' => 'user-icon')) }}
					{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}


					<span>
					<div class="star_wrap">
						@include('ratings.stars', array('rating' => $rating->stars ))
					</div>
					


					<strong>  {{ $rating->rator->display_name }}</strong> on {{ date('d/m/Y' , strtotime($rating->created_at))}} </span>
					<p>{{ $rating->comment}}</p>
				</div>
			</div>
			
		@endforeach
		</div>
	</div>

@stop


