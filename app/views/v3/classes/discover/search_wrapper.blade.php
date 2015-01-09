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
        >
    </ui-gmap-markers>

    </ui-gmap-markers>


</ui-gmap-google-map>

<ul class="list-group">
    <li ng-repeat="everciseGroup in everciseGroups" class="list-group-item">
        {[{ everciseGroup.id }]}
    </li>
</ul>
