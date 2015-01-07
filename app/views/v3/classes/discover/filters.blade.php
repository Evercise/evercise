<div class="discover-nav container-fluid">
    <div class="container">
        <div class="row">
            {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get', 'id' => 'search-classes']) }}
                <div class="col-sm-3 sm-mb10">
                    <div class="input-group with-addon">
                        <div class="input-group-addon"><span class="icon icon-search"></span></div>
                        {{ Form::text('search', isset($search) ? $search : null,['class' => 'form-control', 'placeholder' => 'Search for classes...']) }}
                    </div>
                </div>
                <div class="col-sm-3 sm-mb10">
                    <div class="input-group with-addon">
                        <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                        {{ Form::text('location',  isset($area->name) ? $area->name : null, ['class' => 'form-control', 'placeholder' => 'Location...', 'id' => 'location-auto-complete']) }}
                    </div>
                </div>
                <div class="col-sm-3 sm-mb10">
                    <div class="input-group with-addon">
                        <div class="input-group-addon"><span class="icon icon-distance"></span></div>
                        <div class="custom-select">
                            {{ Form::select( 'distance' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')), ['class' => 'form-control mr50']) }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 sm-text-center">
                    {{ Form::submit('Find a Class', ['class' => 'btn btn-primary mr10 md-btn-block']) }}
                    <div ng-if="results > 0" class="pull-right mt10 visible-lg-block  visible-md-block">
                        <span ng-click="changeView('gridview')" class="icon icon-grid mr10 hover" ng-class="{active : view == 'gridview'}"></span>
                        <span ng-click="changeView('listview')" class="icon icon-list mr10 hover" ng-class="{active : view == 'listview'}"></span>
                        <span ng-click="changeView('mapview')" class="icon icon-map hover" ng-class="{active : view == 'mapview'}"></span>
                    </div>
                </div>

            {{ Form::close() }}
        </div>

    </div>
</div>