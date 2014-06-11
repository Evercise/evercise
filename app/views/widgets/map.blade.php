<div class="map-wrapper">
	<div id="map-canvas" ></div>
</div>

@if(isset($form)) 
	{{ Form::hidden( 'latbox' , isset($lat) ? $lat : '', array('id' => 'latbox', 'form' => $form)) }}
	{{ Form::hidden( 'lngbox' , isset($lng) ? $lng : '', array('id' => 'lngbox', 'form' => $form)) }}
@else
	{{ Form::hidden( 'lngbox' , isset($lng) ? $lng : '', array('id' => 'lngbox')) }}
	{{ Form::hidden( 'latbox' , isset($lat) ? $lat : '', array('id' => 'latbox')) }}
@endif

