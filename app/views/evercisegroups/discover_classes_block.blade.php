<div class="row9">
	@foreach ($evercisegroups as $key => $value) 
		<div class="col3">
			@include('layouts.classBlock', array('evercisegroupId' => $value->id,'title' => $value->name , 'description' =>$value->description ,  'image' => 'profiles/'.$value->user->directory .'/'. $value->image,  'distance' => $miles[$key], 'default_price' => $value->default_price, 'default_size' => $value->capacity ))
			
		</div>

	@endforeach
</div>