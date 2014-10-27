<div class="map-wrapper" ng-class="{ open : isPreviewOpen}">
    <ui-gmap-google-map center="map.center" zoom="map.zoom" draggable="true" refresh="{mapResize}">
        <ui-gmap-markers
            models="markers"
            coords="'self'"
            idKey="'id'"
            fit = "true"
            icon = "'icon' "
            click = "'click'"
            doRebuildAll = "false"
            doCluster = "true"
            clusterEvents="clusterEvents"
            >

        </ui-gmap-markers>
    </ui-gmap-google-map>
</div>