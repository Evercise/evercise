@extends('layouts.master')

@section('content' )
	
	<div class="full-width">
	<div class="col8">
		<div class="map-wrapper">
			<div id="map-canvas" ></div>
		</div>
	</div>
		
		{{ var_dump($places)}}
	</div>
@stop