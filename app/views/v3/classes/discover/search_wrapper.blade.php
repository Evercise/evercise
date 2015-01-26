<ui-gmap-google-map center='map.center'
    zoom="map.zoom"
    pan="true"
    options="mapOptions"
    events="mapEvents"
    draggable="true"
    control="map.control"
>
    <ui-gmap-circle
        center="circleOptions.center"
        radius="circleOptions.radius"
        stroke="circleOptions.stroke"
        fill="circleOptions.fill"
    >

    </ui-gmap-circle>

    <ui-gmap-markers
        models="markers"
        coords="'self'"
        idKey="'id'"
        icon = "'icon' "
        click="'onClicked'"
        doCluster = "true"
        clusterOptions = "map.clusterOptions"
        >
    </ui-gmap-markers>

    </ui-gmap-markers>


</ui-gmap-google-map>

<h4>Event buttons</h4>
<div class="panel-body">
    <div class="col-sm-2">
        <button ng-click="nextPage()" class="btn btn-info btn-block">Add page {[{ pageResultNumber.page}]}</button>
    </div>
    <div class="col-sm-2">
        <select class="form-control" ng-model="sort.type" ng-options="option.value as option.name for option in sortOptions" ng-change="sortChanged()"></select>
    </div>
    <div class="col-sm-2">
        <select class="form-control" ng-model="distance.type" ng-options="option.value as option.name for option in distanceOptions" ng-change="distanceChanged()"></select>
    </div>
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

<h4>Classes {[{ everciseGroups.length }]} of {[{ totalHits }]}</h4>
<ul class="list-group">
    <li ng-repeat="everciseGroup in everciseGroups" class="list-group-item">
        <img ng-src="/{[{ everciseGroup.user.directory }]}/search_{[{ everciseGroup.image }]}" err-src="/assets/img/icon_default_large_pink.png" >
        {[{ everciseGroup.name }]}
    </li>
    
</ul>
