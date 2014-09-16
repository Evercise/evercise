
{{ Form::open(array('id' => 'search-by-location', 'url' => (!empty($area->link->permalink) ? 'uk/'.$area->link->permalink : 'uk'), 'method' => 'get', 'class' => 'search-form')) }}
	
	

    @include('widgets.autocomplete-category', ['fieldname'=>'search', 'placeholder' => 'Find classes', 'search' => $search])
	@include('widgets.autocomplete-location', ['area'=>(!empty($area) ? $area : false)])

	{{ Form::select( 'radius' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')) ) }}
	{{ Form::submit('Find a Class' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}
@if(isset($places))
	{{ Form::hidden( 'places' ,null , array('id' => 'places')) }}

@else
	{{ Form::hidden( 'places' ,null , array('id' => 'places')) }}
@endif