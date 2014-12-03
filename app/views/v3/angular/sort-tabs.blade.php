<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel fade" class="tab-pane tab-pane-sort" id="filter">
        <ul class="list-group custom-dropdown" ng-style="dropwdownStyle">
            <li class="list-group-item">Distance</li>
            <li  class="list-group-item"><a ng-click="distance = '1' ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#1" >Less than 1 mile<span ng-class="{ active : distance == '1' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="distance = '2' ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#2" >2 miles<span  ng-class="{ active : distance == '2' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="distance = '5' ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#5" >5 miles<span  ng-class="{ active : distance == '5' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="distance = '10' ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#10" >10 miles<span  ng-class="{ active : distance == '10' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
        </ul>
    </div>
    <div role="tabpanel" class="tab-pane tab-pane-sort fade" id="sort">
        <ul class="list-group custom-dropdown" ng-style="dropwdownStyle">
            <li class="list-group-item">Sort by</li>
            <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-clo" ng-click="sort = 'distance'; reverse=false ; closeDropdown('sort')">Distance - Closest First<span ng-class="{ active : sort == 'distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#distance-fur" ng-click="sort = '-distance'; reverse=false ; closeDropdown('sort')">Distance - Furthest First<span ng-class="{ active : sort == '-distance' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-asc" ng-click="sort = 'price'; reverse=false ; closeDropdown('sort')">Price Ascending<span ng-class="{ active : sort == 'price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#price-des" ng-click="sort = '-price'; reverse=false ; closeDropdown('sort')">Price Descending<span ng-class="{ active : sort == '-price' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li class="list-group-item"><a role="menuitem" tabindex="-1" href="#soon" ng-click="sort = 'nextClassDate'; reverse=false ; closeDropdown('sort')" >Soonest<span ng-class="{ active : sort == 'nextClassDate' }" class="pull-right icon icon-checkbox hover"></span></a></li>
        </ul>
    </div>
</div>