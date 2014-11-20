<div id="mapView" ng-show="view == 'mapview'">
    <div class="class-snippet-wrapper side-bar">
        <div class="snippet-header">
            <strong class="ml10">Your search returned <span class="text-primary">{{ results }}</span> results</strong>

        </div>
        <div class="snippet-header sub-menu" role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li role="presentation" id="filter-btn">
                    <a href="#filter" aria-controls="filter" role="tab" data-toggle="tab" ng-click="toggle('filter')">
                        <span class="icon icon-filter mr20"></span>
                        Filter
                        <span class="icon icon-dropdown ml10"></span>
                    </a>
                </li>
                <li role="presentation" id="sort-btn">
                    <a href="#sort" aria-controls="sort" role="tab" data-toggle="tab" ng-click="toggle('sort')">
                        <span class="icon icon-sort mr20"></span>
                        Sort
                        <span class="icon icon-dropdown ml10"></span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel fade" class="tab-pane" id="filter">
                    <ul class="list-group">
                        <li class="list-group-item">Distance</li>
                        <li  class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-clo" >Less than 1 mile<span class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li  class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-fur" >2 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li  class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-asc" >5 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li  class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-des" >10 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                    </ul>
                </div>
                <div role="tabpanel fade" class="tab-pane" id="sort">
                    <ul class="list-group">
                        <li class="list-group-item">Sort by</li>
                        <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-clo" ng-click="sort = 'distance'; reverse=false">Distance - Closest First<span ng-class="{ active : sort == 'distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-fur" ng-click="sort = '-distance'; reverse=false">Distance - Furthest First<span ng-class="{ active : sort == '-distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-asc" ng-click="sort = 'price'; reverse=false">Price Ascending<span ng-class="{ active : sort == 'price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-des" ng-click="sort = '-price'; reverse=false">Price Descending<span ng-class="{ active : sort == '-price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                        <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#soon" ng-click="sort = 'nextClassDate'; reverse=false" >Soonest<span ng-class="{ active : sort == 'nextClassDate' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div id="main_block_with_scroll" class="snippet-body mb-scroll">

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
                        <small>Distance : {{ marker.distance }} Miles</small>
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

    <div class="side-bar class-preview  mb-scroll" id="{{ preview.id }}" ng-class="{ open : isPreviewOpen}">
        <div class="preview-return" ng-click="returnPreview()">
            <span class="icon icon-grey-left-arrow"></span>
        </div>
        <div class="hero hero-sm mb25" style="background-image: {{ preview.image }}  ">
            <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
                <ul class="nav navbar-nav nav-justified nav-no-float">
                    <li class="active"><a href="#about" data-toggle="tab">About</a></li>
                    <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-12 tab-content">
            <div role="tabpanel" class="tab-pane active" id="about">
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
            <div role="tabpanel" class="tab-pane" id="schedule">
                <div ng-repeat="session in preview.sessions | orderBy: date_time:reverse">
                    <div class="well" >
                        {{ session.date_time }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="reviews">
                <div ng-repeat="review in preview.reviews" >

                    <div class="well" >
                        <div class="class-rating-wrapper">
                            <span class="icon icon-full-star" ng-repeat="n in [] | repeat:review.stars"></span>
                            <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - review.stars"></span>
                        </div>
                        <p>{{ review.comment }}</p>
                    </div>

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
                 clusterOptions = "clusterOptions"
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
