{{ Form::open(array('id' => 'search-by-location', 'url' => 'evercisegroups/search/'.Str::quickRandom(5), 'method' => 'get', 'class' => 'search-form')) }}
	@if(isset($places))
		{{ Form::hidden( 'places' ,$places , array('id' => 'places')) }}

	@else
		{{ Form::hidden( 'places' ,null , array('id' => 'places')) }}
	@endif
	{{ Form::text( 'location' , null, array('placeholder' => 'Enter Location', 'maxlength' => 50)) }}

	{{ Form::select( 'category' , $types ) }}
	{{ Form::select( 'radius' , $radiuses ) }}
	{{ Form::submit('Search classes' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}