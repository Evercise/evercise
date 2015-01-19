<div ng-if="results > 0" ng-cloak>
    @include('v3.angular.map-template')

    @include('v3.angular.list-template')

    @include('v3.angular.grid-template')

    @include('v3.angular.sort-tabs')
</div>
<div ng-if="results == 0">
    <div class="container first-container">
        <div class="row" >
            <div class="col-sm-12 mt50" >
                <div class="mt50 text-center alert alert-danger fade in" role="alert">
                      <strong>No results!</strong> try again using the seach box above
                </div>
            </div>
        </div>
    </div>
</div>