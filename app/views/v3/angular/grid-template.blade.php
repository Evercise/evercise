<div id="gridview" ng-show="view == 'gridview'" class="discover-nav-spacer">
    <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row mt15">

                <div class="col-sm-6 mt5 mb15 sm-text-center">
                    <strong>Your search return <span class="text-primary">{[{ filteredResults.length }]}</span> results</strong>
                </div>

                <div class="col-md-6 mb15">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <div class="row">
                            <li role="presentation" class="col-xs-6 filter-btn">
                                <a href="#filter" aria-controls="filter" role="tab" data-toggle="tab" ng-click="toggle($event,'filter')">
                                    <span class="icon icon-filter mr20"></span>
                                    Filter
                                    <span class="icon icon-dropdown ml10"></span>
                                </a>
                            </li>
                            <li role="presentation" class="col-xs-6 sort-btn">
                                <a href="#sort" aria-controls="sort" role="tab" data-toggle="tab" ng-click="toggle($event,'sort')">
                                    <span class="icon icon-sort mr20"></span>
                                    Sort
                                    <span class="icon icon-dropdown ml10"></span>
                                </a>
                            </li>
                        </div>

                    </ul>
                </div>

                <div class="col-sm-4"  ng-repeat="marker in markers | orderBy: sort:reverse | filter: distanceFilter" id = {[{marker.id}]}>
                    <ul class="list-group class-module">
                        <div class="class-image-wrapper">
                             <a href="{[{ marker.link }]}">
                                 {{ image('{[{marker.directory}]}/module_{[{ marker.image}]}', '{[{ marker.name}]}', ['class' => 'img-responsive']) }}
                             </a>
                        </div>
                        <li class="list-group-item">

                            <div class="class-title-wrapper text-center">
                                <a href="{[{ marker.link }]}"><h3>{[{ marker.name | truncate:28  }]}</h3></a>
                                <div class="class-rating-wrapper">
                                    <span ng-class="n + 1 <= marker.stars ? 'icon-full-star' : 'icon-empty-star'"  class="icon" ng-repeat="n in [] | repeat:5"></span>

                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-light-grey">
                            <div class="class-info-wrapper  row">
                                <div class="col-xs-6">
                                    <span class="icon icon-clock"></span> <small><time>{[{ marker.nextClassDate  }]}</time></small>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row no-gutter">
                                        <div class="col-xs-7"><span class="icon icon-watch"></span> <small>{[{ marker.nextClassDuration}]} mins</small></div>
                                        <div class="col-xs-5"><span class="icon icon-ticket"></span> <small>x {[{ marker.capacity }]}</small></div>
                                    </div>
                                </div>


                            </div>
                        </li>
                        <li class="list-group-item bg-light-grey">
                            <div class="class-info-wrapper  row">
                                <div class="col-xs-6 mt5" ><strong class="text-large text-primary">{[{ marker.price | currency:"£": 2 }]}</strong></div>
                                <div class="col-xs-6"><a href="{[{ marker.link }]}" class="btn btn-default pull-right">Join Class</a></div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</div>