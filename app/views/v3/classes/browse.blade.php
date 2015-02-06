<ul class="nav navbar-nav nav-browse hidden-xs hidden-sm"ng-controller="browseController" ng-cloak>
        <div class="row">
            <div class="col-xs-2">
                <li class="custom-cat-select">
                    <a href="#" ng-click="catsIsVisible = !catsIsVisible">Classes by<br><strong>Category </strong><span ng-class="(catsIsVisible) ? 'dropup' :  ''"><span class="caret ml5"></span></span></a>
                </li>
            </div>
            <div class="col-xs-10" >
                <div class="row">
                    {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-6">
                        <div class="input-group">
                              <div class="input-group-addon"><span class="icon icon-search"></span></div>
                              <input type="text" name="search" class="form-control" placeholder="Search for Classes..." value="{[{searchTerm}]}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                            <input value="{[{ location }]}" name="location" class="form-control" placeholder="Location" id="location-auto-complete" data-toggle="dropdown" autocomplete="off">
                            <ul id="locaction-autocomplete" class="dropdown-menu category-select" >
                                <li id="near-me" class="heading locator"><span class="icon icon-locator-pink-small"></span>Use my Current Location</li>
                                <div class="autocomplete-content"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        {{ Form::hidden('city', null) }}
                        {{ Form::submit('Find a class' , ['class' => 'btn btn-primary btn-block']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="nav-categories" id="browse-cats" ng-init="catsIsVisible = false" ng-show="catsIsVisible" ng-mouseleave="catsIsVisible = false">
            <div class="row no-gutter ml0 mr0">
                <div class="col-xs-4">
                    <ul class="items">
                        <li ng-repeat="cat in categories track by cat.name"><a ng-class="activeCat == cat.name ? 'active' : ''" href="#{[{ cat.name }]}" ng-mouseenter="subCategories($event, cat ); activeCatSwitch(cat.name)" ng-click="$event.preventDefault();submit(cat.name);">{[{ cat.name }]}<span class="caret-right"></span></a></li>
                    </ul>
                </div>
                <div ng-init="browseIsVisible = false" ng-show="browseIsVisible"  class="col-xs-8">
                    <div class="tab" ng-style="browseTabHeight()">
                        <p>{[{ browse.description }]}</p>
                        <strong class="text-larger">Popular Classes</strong>
                        <div class="mt10 mb15">
                            <button ng-repeat="(key, pop) in browse.popular_subcategories track by key" ng-click="$event.preventDefault();submit(pop.name);" class="btn btn-rounded btn-white mr20">{[{ pop.name }]}</button>
                        </div>
                        <strong class="text-larger">Types of {[{ browse.name }]}</strong>

                        <ul class="mt10">
                            <li class="col-xs-4" ng-repeat="subCat in browse.generated_subcategories track by $index"><a href="#" ng-click="$event.preventDefault();submit(subCat.name);">{[{ subCat.name }]} ({[{ subCat.classes }]})</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </ul>