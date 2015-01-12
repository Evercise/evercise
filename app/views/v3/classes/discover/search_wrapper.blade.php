<ui-gmap-google-map center='map.center'
    zoom="map.zoom"
    pan="true"
    options="mapOptions"
    events="mapEvents"
    draggable="true"
>
    <ui-gmap-markers
        models="markers"
        coords="'self'"
        idKey="'id'"
        icon = "'icon' "
        fit = "true"
        click="'onClicked'"
        >
    </ui-gmap-markers>

    </ui-gmap-markers>


</ui-gmap-google-map>

<h4>Event buttons</h4>
<div class="row">
    <div class="col-sm-2">
        <button ng-click="nextPage()" class="btn btn-info btn-block">Add page {[{ pageResultNumber.page}]}</button>
    </div>
    <div class="col-sm-2">
        <select class="form-control" ng-model="sort.type" ng-options="option.value as option.name for option in sortOptions" ng-change="sortChanged(sort)"></select>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-2"></div>
    <div class="col-sm-2"></div>
    <div class="col-sm-2"></div>
</div>






<h4>Venue results loaded here</h4>
<ul class="list-group" ng-if="venueResults">
    <li ng-repeat="venueClass in venueResults" class="list-group-item">
        {[{ venueClass.name }]}
    </li>
</ul>

<h4>Classes</h4>
<ul class="list-group">
    <li ng-repeat="everciseGroup in everciseGroups" class="list-group-item">
        {[{ everciseGroup.name }]}
    </li>
</ul>
