
@if(isset($loadAutocompleteScript)/* Only runs from homepage, as the map is not also loaded */) 
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places"></script>
@endif


<div id="locationField">
  <script type="text/javascript">
        var area_id = '<?=(!empty($area->name) ? $area->name : '') ?>';
        var area_name = '<?=(!empty($area->name) ? $area->name : '') ?>';
        var area_link = '<?=(!empty($area->link->permalink) ? $area->link->permalink : '')?>';
  </script>
  <input type="hidden" name="area_id"  id="area_id" value="<?=(!empty($area->id) ? $area->id : '') ?>"/>
  <input id="location"
  placeholder="{{trans('discover.location_box')}}" type="text" name="location" value="<?=(!empty($area->name) ? $area->name : '') ?>"/>
</div>
 