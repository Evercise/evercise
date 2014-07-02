{{ Form::open(array('id' => 'search-by-location', 'url' => 'evercisegroups/search/classes', 'method' => 'get', 'class' => 'search-form')) }}
	@if(isset($places))
		{{ Form::hidden( 'places' ,$places , array('id' => 'places')) }}

	@else
		{{ Form::hidden( 'places' ,null , array('id' => 'places')) }}
	@endif
	{{ Form::text( 'location' , isset($selectedLocation) ? $selectedLocation : null , array('placeholder' => 'Enter Location', 'maxlength' => 50 , 'data-default' => 'london')) }}

	{{ Form::select( 'category' , $types, isset($selectedTypes) ? $selectedTypes : null)  }}
	{{ Form::select( 'radius' , $radiuses , isset($selectedLocation) ? $selectedLocation : 25 ) }}
	{{ Form::submit('Find a Class' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}