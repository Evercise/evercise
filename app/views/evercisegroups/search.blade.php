@extends('layouts.master')

@section('content' )

<div class="full-width">
	<div class="col3" id="discover-left">
		<h4>Refine Search</h4>
		@include('evercisegroups.refine')
	</div>

	<div class="col9" id="discover-right">
		@include('evercisegroups.discover_map', array('places' => $evercisegroups))
		<div class="heading-block">
			<h4>Classes</h4>
			<span data-view="list" id="list-view" class="icon-btn list-icon"></span>
			<span data-view="grid" id="grid-view" class="icon-btn grid-icon selected"></span>
		</div>
		<div id="grid" class="discover-view tab-view selected">
			@include('evercisegroups.discover_classes_block', array('classes' => $evercisegroups, 'rating' => $stars ))
		</div>
		<div id="list" class="discover-view tab-view">
			<div class="row9">
				@if (isset($evercisegroups)) 
					@foreach ($evercisegroups as $key => $venue) 
						
							@foreach ($venue->evercisegroup as $k => $evercisegroup)
								{{ var_dump($venue->evercisesessions)}}


									@if (isset($stars[$evercisegroup->id])) 
										@include('evercisegroups.discover_classes_list', array('rating' => array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]), 'lat'=> $venue->lat, 'lng' => $venue->lng, 'classes' => $evercisegroups))
										@else
										@include('evercisegroups.discover_classes_list', array('rating' => 0, 'lat'=> $venue->lat, 'lng' => $venue->lng, 'classes' => $evercisegroups))
									@endif
								
								
							@endforeach	
					
					@endforeach
				@endif
				
			</div>
		</div>
		
	</div>
</div>

@stop