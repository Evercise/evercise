<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane tab-pane-sort fade" id="filter">
        <ul class="list-group custom-dropdown" ng-style="dropwdownStyle">
            <li class="list-group-item">Distance</li>
            <li  class="list-group-item"><a ng-click="setDistance('0.5') ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:0.5mi" >Less than 1 mile<span ng-class="{ active : maxDistance == '0.5' }" class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('1') ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:1mi" >1 mile<span  ng-class="{ active : maxDistance == '1' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('2') ; closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:2mi" >2 miles<span  ng-class="{ active : maxDistance == '2' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('3'); closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:3mi" >3 Miles<span  ng-class="{ active : maxDistance == '3' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('5'); closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:5mi" >5 Miles<span  ng-class="{ active : maxDistance == '5' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('10'); closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:10mi" >10 Miles<span  ng-class="{ active : maxDistance == '10' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
            <li  class="list-group-item"><a ng-click="setDistance('25'); closeDropdown('filter')" role="menuitem" tabindex="-1" href="#Distance:25mi" >25 Miles<span  ng-class="{ active : maxDistance == '25' }"  class="pull-right icon icon-checkbox hover"></span></a></li>
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