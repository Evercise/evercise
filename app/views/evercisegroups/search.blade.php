@extends('layouts.master')

@section('content' )

@if(!isset($user))
    <div class="add-block">
            <h3>Register today and receive up to <span class="highlight">£8</span> of evercoins to use against any class bookings</h3>
        </div>
        <div class="mb40"></div>
@endif

<div class="full-width">

	<div class="col3" id="discover-left">
		<h3>Refine Search</h3>
		@include('evercisegroups.refine')
		<br>
		<br>
		@include('evercisegroups.recommended', ['loadAutocompleteScript'=>1])
	</div>

	<div class="col9" id="discover-right">
		@include('evercisegroups.discover_map', array('places' => $evercisegroups))
		<div class="heading-block">
			@if(Input::get('location'))
				<h4>{{ ucfirst( (Input::get('category')?Input::get('category').' ':'') . trans('discover.classes_near').' ') . Str::limit( Input::get('location'),52)}}</h4>
			@else
				<h4>{{ ucfirst( (Input::get('category')?Input::get('category').' ':'') . trans('discover.classes_in_your_area') ) }}</h4>
			@endif
			@if(Input::get('view'))
				@if(Input::get('view') == 'grid')
					<span data-view="list" id="list-view" class="icon-btn list-icon"></span>
					<span data-view="grid" id="grid-view" class="icon-btn grid-icon selected"></span>

				@else
					<span data-view="list" id="list-view" class="icon-btn list-icon selected"></span>
					<span data-view="grid" id="grid-view" class="icon-btn grid-icon"></span>
				@endif
			@else
				<span data-view="list" id="list-view" class="icon-btn list-icon"></span>
				<span data-view="grid" id="grid-view" class="icon-btn grid-icon selected"></span>
			@endif
			{{ Form::hidden( 'view-select' , 'grid', array('id' => 'view-select')) }}
		</div>
		
		@if(Input::get('view'))
			<div id="grid" class="discover-view tab-view {{Input::get('view') == 'grid'? 'selected' : null}}">
				@include('evercisegroups.discover_classes_block', array('classes' => $evercisegroups ))
			</div>

			<div id="list" class="discover-view tab-view {{Input::get('view') == 'list'? 'selected' : null}}">

			<div class="row9 mb20">
				@if (isset($evercisegroups)) 
					@foreach ($evercisegroups as $key => $evercisegroup) 
						@include('evercisegroups.discover_classes_list', array('rating' => $evercisegroup->getStars(), 'lat'=> $evercisegroup->venue->lat, 'lng' => $evercisegroup->venue->lng ))
					@endforeach
				@endif
				
			</div>
		</div>
		@else
			<div id="grid" class="discover-view tab-view selected">
				@include('evercisegroups.discover_classes_block', array('classes' => $evercisegroups ))
			</div>

			<div id="list" class="discover-view tab-view">

			<div class="row9 mb20">
				@if (isset($evercisegroups)) 
					@foreach ($evercisegroups as $key => $evercisegroup) 
						@include('evercisegroups.discover_classes_list', array('rating' => $evercisegroup->getStars(), 'lat'=> $evercisegroup->venue->lat, 'lng' => $evercisegroup->venue->lng ))
					@endforeach
				@endif
				
			</div>
		</div>
		@endif
		
		@if(Input::get('view'))
			<div id="gridView" class="view-pag {{Input::get('view') == 'grid'? 'selected' : 'hidden'}}"> 
				{{ $evercisegroups->appends(['view' => 'grid', 'category' => Input::get('category'), 'location' => Input::get('location') , 'radius' => Input::get('radius')])->links()}}
			</div>
			<div id="listView" class="view-pag {{Input::get('view') == 'list'? 'selected' : 'hidden'}}">
				{{ $evercisegroups->appends(['view' => 'list', 'category' => Input::get('category'), 'location' => Input::get('location') , 'radius' => Input::get('radius')])->links()}}
			</div>
		@else
			<div id="gridView" class="view-pag"> 
				{{ $evercisegroups->appends(['view' => 'grid', 'category' => Input::get('category'), 'location' => Input::get('location') , 'radius' => Input::get('radius')])->links()}}
			</div>
			<div id="listView" class="view-pag hidden">
				{{ $evercisegroups->appends(['view' => 'list', 'category' => Input::get('category'), 'location' => Input::get('location') , 'radius' => Input::get('radius')])->links()}}
			</div>

		@endif
			
		
		
	</div>
</div>

@stop