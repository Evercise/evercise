
@if(isset($loadAutocompleteScript)/* Only runs from homepage, as the map is not also loaded */) 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
@endif

<div id="locationField">
  <input id="location" placeholder="Enter a city" type="text" name="location" />
</div>
