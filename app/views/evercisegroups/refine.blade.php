{{ Form::open(array('id' => 'search-by-location', 'url' => 'evercisegroups/search/classes', 'method' => 'get', 'class' => 'search-form')) }}
	
	

    @include('widgets.autocomplete-category', ['fieldname'=>'category'])
	@include('widgets.autocomplete-location')

	{{ Form::select( 'radius' , $radiuses , isset($selectedRadius) ? $selectedRadius : 3958 ) }}
	{{ Form::submit('Find a Class' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}
@if(isset($places))
	{{ Form::hidden( 'places' ,$places , array('id' => 'places')) }}

@else
	{{ Form::hidden( 'places' ,null , array('id' => 'places')) }}
@endif