<div class="discover-nav container-fluid">
    <div class="container">
        <div class="row">
            {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get', 'id' => 'search-classes']) }}
                <div class="col-sm-4">
                    <div class="input-group with-addon">
                        <div class="input-group-addon"><span class="icon icon-search"></span></div>
                        {{ Form::text('search', null,['class' => 'form-control', 'placeholder' => 'Search for classes...']) }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group with-addon">
                        <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                        {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location...']) }}
                    </div>
                </div>
                <div class="col-sm-4">
                    {{ Form::hidden('distance', '2mi') }}
                    {{ Form::submit('Find a Class', ['class' => 'btn btn-primary mr10']) }}
                    <div class="pull-right mt10">
                        <span ng-click="changeView('gridview')" class="icon icon-grid mr10 hover" ng-class="{active : view == 'gridview'}"></span>
                        <span ng-click="changeView('listview')" class="icon icon-list mr10 hover" ng-class="{active : view == 'listview'}"></span>
                        <span ng-click="changeView('mapview')" class="icon icon-map hover" ng-class="{active : view == 'mapview'}"></span>
                    </div>
                </div>

            {{ Form::close() }}
        </div>


    </div>
</div>