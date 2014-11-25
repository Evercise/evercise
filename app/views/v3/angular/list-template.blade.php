<div id="listview" ng-show="view == 'listview'" class="discover-nav-spacer">
    <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row">
                <div class="mt15 mb20 pull-left">
                    <div class="col-sm-6 mt5">
                        <strong>Your search return <span class="text-primary">{[{ results }]}</span> results</strong>
                    </div>

                    <div class="col-sm-6">
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
                <div class="col-sm-12" ng-repeat="marker in markers | orderBy: sort:revers | filter: distanceFiltere" id = {[{marker.id}]}>
                    <div class="class-list center-block row">
                        <div class="class-image-wrapper col-xs-2">
                            {{ image('{[{marker.directory}]}/search_{[{ marker.image}]}', '{[{ marker.name}]}') }}
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <h3>{[{ marker.name  }]}</h3>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
                                <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <span class="icon icon-clock"></span> {[{ marker.nextClassDate | date : 'MMM d, h:mma'  }]}
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-md-6"><span class="icon icon-clock"></span> {[{ marker.nextClassDuration}]} mins</div>
                                        <div class="col-dm-6"><span class="icon icon-ticket"></span> x {[{ marker.capacity }]} left</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="class-info-wrapper col-xs-2 bg-light-grey text-center">
                            <strong class="text-primary center-block">&pound;{[{ marker.price }]}</strong>
                            <a href="{[{ marker.link }]}" class="btn btn-default center-block">Join Class</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>