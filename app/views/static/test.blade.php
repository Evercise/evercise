@extends('layouts.fullWidthMaster')

@section('content' )

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>

<script>



function initAutocomplete() {
  var myOptions = {
    zoom: 5,
    center: new google.maps.LatLng(54.8, -4.6),
    mapTypeControl: false,
    panControl: false,
    zoomControl: false,
    streetViewControl: false
  };

  // Create the autocomplete object and associate it with the UI input control.
  var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'),
      myOptions
  );

  //google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);

}

jQuery( document ).ready( function( $ )
{
	initAutocomplete();
});
</script>

<div class="container-full">


	<div id="locationField">
      <input id="autocomplete" placeholder="Enter a city" type="text" />
    </div>


</div>



@stop