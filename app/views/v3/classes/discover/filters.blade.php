<div class="discover-nav container-fluid">
    <div class="container">
        <div class="row">
            {{ Form::open(['route' => 'home', 'method' => 'post', 'id' => 'search-classes']) }}
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
                    {{ Form::submit('Find a Class', ['class' => 'btn btn-primary mr10']) }}
                    <div class="pull-right mt10">
                        <span ng-click="changeView('gridview')" class="icon icon-grid mr10 hover" ng-class="{active : view == 'gridview'}"></span>
                        <span ng-click="changeView('listview')" class="icon icon-list mr10 hover" ng-class="{active : view == 'listview'}"></span>
                        <span ng-click="changeView('mapview')" class="icon icon-map hover" ng-class="{active : view == 'mapview'}"></span>
                    </div>
                </div>



                <!--<div class="col-sm-5">
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

                        <div class="col-sm-4 no-gutter">
                            <div class="form-group">
                                <span ng-click="changeView('gridview')" class="icon icon-grid mr10 hover" ng-class="{active : view == 'gridview'}"></span>
                                <span ng-click="changeView('listview')" class="icon icon-list mr10 hover" ng-class="{active : view == 'listview'}"></span>
                                <span ng-click="changeView('mapview')" class="icon icon-map hover" ng-class="{active : view == 'mapview'}"></span>
                            </div>

                        </div>
                    </div>

                </div>-->


            {{ Form::close() }}
        </div>


    </div>





</div>