<div id="gridview" ng-show="view == 'gridview'" class="discover-nav-spacer">
    <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row">
                <div class="mt15 mb20 pull-left">
                    <div class="col-sm-6 mt5">
                        <strong>Your search return <span class="text-primary">{[{ results }]}</span> results</strong>
                    </div>

                    <div class="col-md-6">
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
                </div>
                <div class="col-md-4"  ng-repeat="marker in markers | orderBy: sort:reverse | filter: distanceFilter" id = {[{marker.id}]}>

                    <div class="class-module center-block">
                        <div class="class-image-wrapper">
                            <a href="{[{ marker.link }]}">
                                {{ image('{[{marker.directory}]}/module_{[{ marker.image}]}', '{[{ marker.name}]}') }}
                            </a>
                        </div>
                        <div class="class-title-wrapper text-center">
                            <a href="{[{ marker.link }]}"><h3>{[{ marker.name  }]}</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                                <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                            </div>
                        </div>
                        <div class="class-info-wrapper panel-body bg-light-grey row">
                            <div class="col-xs-6">
                                <span class="icon icon-clock"></span> {[{ marker.nextClassDate  }]}
                            </div>
                            <div class="col-xs-6">
                                <div class="row no-gutter">
                                    <div class="col-xs-7"><span class="icon icon-watch"></span> {[{ marker.nextClassDuration}]} mins</div>
                                    <div class="col-xs-5"><span class="icon icon-ticket"></span> x {[{ marker.capacity }]}</div>
                                </div>

                            </div>

                        </div>
                        <div class="class-info-wrapper panel-body bg-light-grey row">
                            <div class="col-xs-6" ><strong class="text-primary">&pound;{[{ marker.price }]}</strong></div>
                            <div class="col-xs-6"> <a href="{[{ marker.link }]}" class="btn btn-default pull-right">Join Class</a></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>