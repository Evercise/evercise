
@if(isset($loadAutocompleteScript)/* Only runs from homepage, as the map is not also loaded */) 
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places"></script>
@endif

<div id="locationField">
  <input id="location" placeholder="{{trans('discover.location_box')}}" type="text" name="location" value="{{ isset($selectedLocation) ? $selectedLocation : '' }}"/>
</div>
