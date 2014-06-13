<div class="row9">
	@foreach ($evercisegroups as $key => $venue) 
		@foreach ($venue->evercisegroup as $k => $evercisegroup) 
			<div class="col3">
				@include('layouts.classBlock', array( 'rating' => array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]), 'lat'=> $venue->lat, 'lng' => $venue->lng, 'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
			</div>
		@endforeach
	@endforeach
</div>
