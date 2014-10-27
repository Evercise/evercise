<div class="discover-nav container-fluid">
    <div class="container">
        <div class="row">
            <form  role="form">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group col-sm-12 with-addon">
                                <div class="input-group-addon"><span class="icon icon-search"></span></div>
                                <input class="form-control" type="text" placeholder="Search for Classes...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                         Find a Class
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-4">
                             <button type="button" class="btn btn-form-control dropdown-toggle" data-toggle="dropdown">
                               filter
                             </button>
                             <ul class="dropdown-menu" role="menu">
                                <li role="presentation" class="dropdown-header">Distance</li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#distance-clo" >Less than 1 mile<span class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#distance-fur" >2 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#price-asc" >5 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#price-des" >10 miles<span class="pull-right icon icon-checkbox hover"></span></a></li>
                             </ul>
                        </div>
                        <div class="col-sm-4">
                             <button type="button" class="btn btn-form-control dropdown-toggle" data-toggle="dropdown">
                               Sort
                             </button>
                             <ul class="dropdown-menu" role="menu">
                                <li role="presentation" class="dropdown-header">Sort by</li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#distance-clo" ng-click="sort = 'distance'; reverse=false">Distance - Closest First<span ng-class="{ active : sort == 'distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#distance-fur" ng-click="sort = '-distance'; reverse=true">Distance - Furthest First<span ng-class="{ active : sort == '-distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#price-asc" ng-click="sort = 'price'; reverse=false">Price Ascending<span ng-class="{ active : sort == 'price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#price-des" ng-click="sort = '-price'; reverse=false">Price Descending<span ng-class="{ active : sort == '-price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#soon" ng-click="sort = 'nextClassDate'; reverse=false" >Soonest<span ng-class="{ active : sort == 'nextClassDate' }" class="pull-right icon icon-checkbox hover"></span></a></li>
                             </ul>
                        </div>
                        <div class="col-sm-4 no-gutter">
                            <div class="form-group">
                                <span ng-click="changeView('gridview')" class="icon icon-grid mr10 hover" ng-class="{active : view == 'gridview'}"></span>
                                <span ng-click="changeView('listview')" class="icon icon-list mr10 hover" ng-class="{active : view == 'listview'}"></span>
                                <span ng-click="changeView('mapview')" class="icon icon-map hover" ng-class="{active : view == 'mapview'}"></span>
                            </div>

                        </div>
                    </div>

                </div>


            </form>
        </div>


    </div>





</div>