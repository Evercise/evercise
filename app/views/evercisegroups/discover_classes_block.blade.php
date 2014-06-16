<div class="row9">
	@if (isset($evercisegroups)) 
		@foreach ($evercisegroups as $key => $venue) 
			@if (isset($venue->evercisegroup)) 
				@foreach ($venue->evercisegroup as $k => $evercisegroup) 
					<div class="col3">
						@if (isset($stars[$evercisegroup->id])) 
							@include('layouts.classBlock', array( 'rating' => array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]), 'lat'=> $venue->lat, 'lng' => $venue->lng, 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
						@else
							@include('layouts.classBlock', array( 'rating' => 0, 'lat'=> $venue->lat, 'lng' => $venue->lng, 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
						@endif
					</div>

				@endforeach
			@endif
		@endforeach
	@endif
</div>
