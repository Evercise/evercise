<div class="map-wrapper">
	<div id="map-canvas" ></div>
</div>

@if(isset($lat)) 
	{{ Form::hidden( 'latbox' , $lat, array('id' => 'latbox')) }}
@else
	{{ Form::hidden( 'latbox' , '', array('id' => 'latbox')) }}
@endif

@if(isset($lng))
	{{ Form::hidden( 'lngbox' , $lng, array('id' => 'lngbox')) }}
@else
	{{ Form::hidden( 'lngbox' , '', array('id' => 'lngbox')) }}
@endif

