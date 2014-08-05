@extends('layouts.master')

@section('content' )

<div class="full-width">
	<div class="col3" id="discover-left">
		<h4>Refine Search</h4>
		@include('evercisegroups.refine')
		<br>
		<br>
		@include('evercisegroups.recommended', ['loadAutocompleteScript'=>1])
	</div>

	<div class="col9" id="discover-right">
		@include('evercisegroups.discover_map', array('places' => $evercisegroups))
		<div class="heading-block">
			@if(Input::get('location'))
				<h4>{{ ucfirst(((Input::get('category')?Input::get('category').' ':'').Loc::text('discover', 'classes_near')).' ') . Str::limit( Input::get('location'),52)}}</h4>
			@else
				<h4>{{ ucfirst(((Input::get('category')?Input::get('category').' ':'').Loc::text('discover', 'classes_in_your_area'))) }}</h4>
			@endif
			<span data-view="list" id="list-view" class="icon-btn list-icon"></span>
			<span data-view="grid" id="grid-view" class="icon-btn grid-icon selected"></span>
		</div>
		
		<div id="grid" class="discover-view tab-view selected">
			@include('evercisegroups.discover_classes_block', array('classes' => $evercisegroups ))
		</div>
		{{ $evercisegroups->appends(['category' => Input::get('category'), 'location' => Input::get('location') , 'radius' => Input::get('radius')])->links()}}
		<div id="list" class="discover-view tab-view">

			<div class="row9">
				@if (isset($evercisegroups)) 
					@foreach ($evercisegroups as $key => $evercisegroup) 
						@include('evercisegroups.discover_classes_list', array('rating' => $evercisegroup->getStars(), 'lat'=> $evercisegroup->venue->lat, 'lng' => $evercisegroup->venue->lng ))
					@endforeach
				@endif
				
			</div>
		</div>
		
	</div>
</div>

@stop