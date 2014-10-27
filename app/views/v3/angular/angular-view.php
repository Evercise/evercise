<div id="mapView" ng-show="view == 'mapview'">
    <div class="class-snippet-wrapper side-bar">
        <div class="snippet-header">
            <strong>Your search returned <span class="text-primary">{{ results }}</span> results</strong>
        </div>
        <div id="main_block_with_scroll" class="snippet-body mb-scroll">

            <div infinite-scroll="loadMore()"  infinite-scroll-container="'#main_block_with_scroll'" infinite-scroll-parent>
                <div ng-repeat="marker in markers | orderBy: sort:reverse"
                     id = {{marker.id}}
                     class="class-snippet"
                     ng-click="clicked(marker)"
                     infinite-scroll-container="'#snippets'">
                    <div class="class-image-wrapper col-sm-4">
                        <img src="{{ marker.image}} " alt="{{ marker.name}}"/>
                    </div>
                    <div class="class-title-wrapper panel-body col-sm-8">
                        <div class="ml10">
                            <h3>{{ marker.name | truncate:20  }}</h3>
                        </div>
                        <div class="class-rating-wrapper col-xs-9">
                            <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                            <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                        </div>
                        <div class="col-xs-3">

                            <strong class="text-primary">&pound;{{ marker.price }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="side-bar class-preview  mb-scroll" id="{{ preview.id }}" ng-class="{ open : isPreviewOpen}">
        <div class="preview-return" ng-click="returnPreview()">
            <span class="icon icon-grey-left-arrow"></span>
        </div>
        <div class="hero hero-sm mb25" style="background-image: {{ preview.image }}  ">
            <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
                <ul class="nav navbar-nav nav-justified nav-no-float">
                    <li class="active"><a href="#about">About</a></li>
                    <li><a href="#schedule">Schedule</a></li>
                    <li><a href="#facilities">Reviews</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-12">
            <div class="underline text-center">
                <h3>About the class</h3>
            </div>
            <div class="row text-center mb30">
                <div class="col-sm-5"><span class="icon icon-clock"></span>{{ preview.nextClassDate | date : 'MMM d, h:mma'  }}</div>
                <div class="col-sm-4"><span class="icon icon-watch"></span> {{ preview.nextClassDuration}} mins</div>
                <div class="col-sm-3"><span class="icon icon-ticket"></span> x {{ preview.capacity }}</div>
            </div>
            <div class="row mb40">
                <div class="col-sm-12 text-center">
                    <p>{{ preview.description }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb20 text-center">
                    <a href="{{ preview.link }}" class="btn btn-grey btn-transparent">Read More</a>
                </div>
            </div>
        </div>
    </div>

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
</div>

<div id="listview" ng-show="view == 'listview'" class="discover-nav-spacer">
    <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt15 mb20">
                    <strong>Your search return <span class="text-primary">{{ results }}</span> results</strong>
                </div>
                <div class="col-sm-12" ng-repeat="marker in markers | orderBy: sort:reverse" id = {{marker.id}}>
                    <div class="class-list center-block row">
                        <div class="class-image-wrapper col-xs-2">
                            <img src="{{ marker.image}} " alt="{{ marker.name}}"/>
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <h3>{{ marker.name  }}</h3>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                                <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <span class="icon icon-clock"></span> {{ marker.nextClassDate | date : 'MMM d, h:mma'  }}
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-md-6"><span class="icon icon-clock"></span> {{ marker.nextClassDuration}} mins</div>
                                        <div class="col-dm-6"><span class="icon icon-ticket"></span> x {{ marker.capacity }} left</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="class-info-wrapper col-xs-2 bg-light-grey text-center">
                            <strong class="text-primary center-block">&pound;{{ marker.price }}</strong>
                            <a href="{{ marker.link }}" class="btn btn-default center-block">Join Class</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gridview" ng-show="view == 'gridview'" class="discover-nav-spacer">
    <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt10 mb20">
                    <strong>Your search return <span class="text-primary">{{ results }}</span> results</strong>
                </div>
                <div class="col-sm-4"  ng-repeat="marker in markers | orderBy: sort:reverse" id = {{marker.id}}>

                    <div class="class-module center-block">
                        <div class="class-image-wrapper">
                            <a href="{{ marker.link }}">
                                <img src="{{ marker.image}} " alt="{{ marker.name}}"/>
                            </a>
                        </div>
                        <div class="class-title-wrapper text-center">
                            <a href="{{ marker.link }}"><h3>{{ marker.name  }}</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                                <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                            </div>
                        </div>
                        <div class="class-info-wrapper panel-body bg-light-grey row">
                            <div class="col-xs-6">
                                <span class="icon icon-clock"></span> {{ marker.nextClassDate | date : 'MMM d, h:mma'  }}
                            </div>
                            <div class="col-xs-6">
                                <div class="row no-gutter">
                                    <div class="col-xs-7"><span class="icon icon-watch"></span> {{ marker.nextClassDuration}} mins</div>
                                    <div class="col-xs-5"><span class="icon icon-ticket"></span> x {{ marker.capacity }}</div>
                                </div>

                            </div>

                        </div>
                        <div class="class-info-wrapper panel-body bg-light-grey row">
                            <div class="col-xs-6" ><strong class="text-primary">&pound;{{ marker.price }}</strong></div>
                            <div class="col-xs-6"> <a href="{{ marker.link }}" class="btn btn-default pull-right">Join Class</a></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
