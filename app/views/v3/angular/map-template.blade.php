<div id="mapView" ng-show="view == 'mapview'">
    <div class="class-snippet-wrapper side-bar">
        <div class="snippet-header">
            <strong class="ml10">Your search returned <span class="text-primary">{[{ results }]}</span> results</strong>

        </div>
        <div class="snippet-header sub-menu" role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li role="presentation" class="filter-btn">
                    <a href="#filter" aria-controls="filter" role="tab" data-toggle="tab" ng-click="toggle($event,'filter')">
                        <span class="icon icon-filter mr20"></span>
                        Filter
                        <span class="icon icon-dropdown ml10"></span>
                    </a>
                </li>
                <li role="presentation" class="sort-btn">
                    <a href="#sort" aria-controls="sort" role="tab" data-toggle="tab" ng-click="toggle($event,'sort')">
                        <span class="icon icon-sort mr20"></span>
                        Sort
                        <span class="icon icon-dropdown ml10"></span>
                    </a>
                </li>
            </ul>
        </div>

        <div id="main_block_with_scroll" class="snippet-body mb-scroll">

            <div ng-repeat="marker in markers | orderBy: sort:reverse | filter: distanceFilter"
                 id = {[{marker.id}]}
                 class="class-snippet"
                 ng-click="clicked(marker)">
                <div class="class-image-wrapper col-sm-4">
                    {{ image('{[{marker.directory}]}/search_{[{ marker.image}]}', '{[{ marker.name}]}') }}
                </div>
                <div class="class-title-wrapper panel-body col-sm-8">
                    <div class="ml10">
                        <h3>{[{ marker.name | truncate:20  }]}</h3>
                        <small>Distance : {[{ marker.distance }]} Miles</small>
                    </div>
                    <div class="class-rating-wrapper col-xs-9">
                        <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                        <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                    </div>
                    <div class="col-xs-3">

                        <strong class="text-primary">&pound;{[{ marker.price }]}</strong>
                    </div>
                </div>
            </div>
        </div>




    </div>

    @include('v3.angular.class-preview-template')

    <div class="map-wrapper" ng-class="{ open : isPreviewOpen}">
        <ui-gmap-google-map center="map.center" zoom="map.zoom"  draggable="true">
            <ui-gmap-markers
                models="markers"
                coords="'self'"
                idKey="'id'"
                fit = "true"
                icon = "'icon' "
                click = "'click'"
                doRebuildAll = "false"
                doCluster = "true"
                clusterOptions = "clusterOptions"
                clusterEvents="clusterEvents"
                >
            </ui-gmap-markers>
        </ui-gmap-google-map>
    </div>
</div>