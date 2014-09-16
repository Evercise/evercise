

<div class="row9">
	@if (isset($evercisegroups)) 
		@foreach ($evercisegroups as $evercisegroup)
			<div class="col3">
				@include('layouts.classBlock', array( 'rating' => $evercisegroup->ratings , 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'venue' => $evercisegroup->venue  , 'sessions' => $evercisegroup->futuresessions,  'default_price' => $evercisegroup->default_price ))
			</div>
		@endforeach
	@endif
</div>

