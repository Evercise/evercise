@extends('layouts.master')

@section('content')
	
	@if(count($ratings) == 0 )
		@include('trainers.trainerBlock', array('speciality' => $trainer->profession , 'orientation' => 'landscape', 'image' => '/profiles/'.  $trainer->user->directory.'/'. $trainer->user->image , 'name' => $trainer->user->display_name , 'trainerRating' => 0 ,'member_since' => date('dS M-Y', strtotime( $trainer->user->created_at))))

	@else
		@include('trainers.trainerBlock', array('speciality' => $trainer->profession , 'orientation' => 'landscape', 'image' => '/profiles/'.  $trainer->user->directory.'/'. $trainer->user->image , 'name' => $trainer->user->display_name , 'trainerRating' => $totalStars / count($ratings) ,'member_since' => date('dS M-Y', strtotime( $trainer->user->created_at))))

	@endif
		<div class="col10 push2">
		<br>
		<br>
		<h5>{{$trainer->user->display_name}}&apos;s classes </h5>
		<br>
		<br>
		@foreach ($evercisegroups as $key => $evercisegroup)


			<div class="col3">
				@include('layouts.classBlock', array( 'rating' => isset($stars[$evercisegroup->id])?  array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]) : 0 ,  'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image, 'venue' => $evercisegroup->venue  , 'sessions' => $evercisegroup->evercisesession,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))

			</div>

		@endforeach

		<div class="rating-wrap">
		<br>
		<br>
		<h5>{{$trainer->user->display_name}}&apos;s Ratings </h5>
		<br>
		<br>
		@foreach ($ratings as $key => $rating) 
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
		@foreach ($ratings as $key => $rating) 
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


