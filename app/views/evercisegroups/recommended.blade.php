<div class="recommended-vertical-wrap">
	<h5>Recommended Classes</h5>
	@foreach( $evercisegroups as $key => $evercisegroup)
		<div class="recommended-block">
			<a href="{{ URL::to('evercisegroups/'.$evercisegroup->id) }}">
				{{ HTML::image('profiles/'.$evercisegroup->user->directory.'/'.$evercisegroup->image, 'class image', array('class' => 'recommended-block-img')); }}
			</a> 
			<h6>{{ $evercisegroup->name }}</h6>

			<div class="recommended-info">
				<div class="recommended-aside">
					<p>{{ $evercisegroup->capacity }}</p>

					<small>Class Size</small>
				</div>
				<div class="recommended-aside">
				@if (count($evercisegroup->ratings) == 0) 
					@include('ratings.stars', array('rating' => 0 ))
				@else
					@include('ratings.stars', array('rating' =>$evercisegroup->ratings / count($evercisegroup->ratings)))
				@endif
				

					<small>Rating</small>
				</div>
				<div class="recommended-aside">
					<p>&pound;{{ $evercisegroup->default_price}}</p>
					<small>Per Person</small>
				</div>
			</div>
		</div>
		
	
@endforeach	
</div>

