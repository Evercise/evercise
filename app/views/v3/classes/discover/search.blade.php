@extends('v3.layouts.master')
<?php  View::share('angular', 'show') ?>
<?php  View::share('footer', 'no') ?>
<?php  View::share('angularApp', 'ng-app="everApp"') ?>
@include('layouts.laracasts')

@section('body')

  <div id="angular-wrapper"  ng-controller="searchController" ng-cloak>

    @include('v3.landing.popup')

    <div class="hidden-xs hidden-sm">
        <ui-gmap-google-map center='map.center'
            zoom="map.zoom"
            pan="true"
            options="mapOptions"
            events="mapEvents"
            draggable="true"
            control="map.control"
        >
            <ui-gmap-markers
                models="everciseGroups"
                coords="'venue'"
                idKey="'id'"
                id="'venue.id'"
                icon = "'icon'"
                doCluster = "true"
                clusterOptions = "map.clusterOptions"
                clusterEvents = "clusterEvents"
                events = "markerEvents"
                >
            </ui-gmap-markers>

            <ui-gmap-circle
                center="circleOptions.center"
                radius="circleOptions.radius"
                stroke="circleOptions.stroke"
                fill="circleOptions.fill"
            >

            </ui-gmap-circle>

        </ui-gmap-google-map>
    </div>


    <div class="results">
        <div ng-if="width < 992" class="row mt10 mb10 ml0 mr0 sm-inline-gutter visible-xs-block visible-sm-block">
             {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                 <div class="col-xs-9 col-sm-10">
                     <div class="input-group">
                         <div class="input-group-addon"><span class="icon icon-search"></span></div>
                         <input type="text" name="search" value="{[{ results.search}]}" class="form-control input-lg" placeholder="I am looking for....Running">
                     </div>
                 </div>
                 <div class="col-xs-3  col-sm-2">
                     <div class="btn-find-me">
                         {{ Form::hidden('location', NULL ) }}
                         {{ Form::hidden('city', NULL) }}
                         {{ Form::submit('' , ['class' => 'btn btn-primary btn-block btn-lg locator', 'id' => 'mobile-sub']) }}
                     </div>
                 </div>
             {{ Form::close() }}
        </div>
        <div class="inner">
            <div ng-if="resultsLoading" class="mask"><div class="loading"></div></div>
            <div class="heading"><div class="row no-gutter ml0"><div class="col-xs-9"><span class="text-primary">{[{ everciseGroups.length }]} {[{ results.search}]}</span> Classes found near <span class="text-primary">{[{ results.area.name }]}</span></div><div class="col-xs-3"><span ng-if="width > 767" class="pull-right mt5"><span class="icon icon-sm-list hover mr5" ng-class="{'active' : (view == 'list') }" ng-click="switchView('list')"></span><span ng-class="{'active' : (view == 'grid') }" ng-click="switchView('grid')" class="icon hover icon-sm-grid"></span></span></div></div>  </div>
            <div role="tabpanel" ng-if="!selectedVenueIds">
                <ul class="nav nav-tabs nav-justified">
                  <li role="presentation"><a ng-click="$event.preventDefault();" href="#filter" class="filter-btn" data-toggle="tab">Filter</a></li>
                  <li role="presentation"><a ng-click="$event.preventDefault();" href="#sort" class="sort-btn" data-toggle="tab">Sort by</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="filter">
                        <div class="row mt25">
                            <div class="col-xs-10 col-xs-offset-1">
                                <!--
                                <strong class="h4">Class time</strong>
                                <div class="filter-slider mt25 mb15">
                                    <a href="#" class="active">All</a>
                                    <a href="#">Morning</a>
                                    <a href="#">Afternoon</a>
                                    <a href="#">Evening</a>
                                </div>
                                -->
                                <strong class="h4">Distance</strong>
                                <div class="filter-slider mt25 mb25">
                                    <a href="#" ng-class="(results.radius == '1mi') ? 'active' : ''" ng-click="results.radius = '1mi'; $event.preventDefault(); ">1 mi</a>
                                    <a href="#" ng-class="(results.radius == '3mi') ? 'active' : ''" ng-click="results.radius = '3mi'; $event.preventDefault();">3 mi</a>
                                    <a href="#" ng-class="(results.radius == '5mi') ? 'active' : ''" ng-click="results.radius = '5mi'; $event.preventDefault();">5 mi</a>
                                    <a href="#" ng-class="(results.radius == '10mi') ? 'active' : ''" ng-click="results.radius = '10mi'; $event.preventDefault();">10 mi</a>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 mb20">
                                        <a ng-click="$event.preventDefault(); getData();" href="#" class="btn btn-block btn-white-primary">Update Results</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane sort-box open" id="sort">
                        <ul class="dropdown-menu open" role="menu" aria-labelledby="dropdownMenu1">
                            <li ng-class="(results.sort == 'best') ? 'active' : ''"><a href="#" ng-click="sortChanged($event, 'best')">Best</a></li>
                            <li ng-class="(results.sort == 'distance') ? 'active' : ''"><a href="#" ng-click="sortChanged($event, 'distance')">Distance</a></li>
                            <li ng-class="(results.sort == 'price_desc') ? 'active' : ''"><a href="#" ng-click="sortChanged($event, 'price_desc')">Price (high to low)</a></li>
                            <li ng-class="(results.sort == 'price_asc') ? 'active' : ''"><a href="#" ng-click="sortChanged($event, 'price_asc')">Price (low to high)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div ng-if="results.results.total > 0 && !selectedVenueIds"  class="date-picker-inline">
                <div class="wrapper">
                    <div class="content" ng-style="scrollWidth()">
                         <li class="date-btn" ng-style="scrollBtnWidth()" ng-repeat="(date, value) in available_dates" ng-class="(date == selectedDate) ? 'active' : ''">
                            <div ng-class="value == 0 ? 'disabled' : ''">
                            <div class="day">{[{ date | date : 'EEE'}]}</div>
                                <a title="{[{value}]} {[{ value == 1 ? 'classes' : 'class'}]} available" href="#" ng-click="changeSelectedDate($event, date)">
                                    {[{ date | date : 'd'}]}<span class="month">{[{ date| date : 'MMM'}]}</span>
                                </a>
                            </div>
                         </li>
                    </div>

                </div>

                 <a href="#"  ng-click="scroll_clicked || scrollDates('left', $event)" class="scroll left" ng-disabled="scroll_clicked" ></a>
                 <a href="#" ng-click="scroll_clicked || scrollDates('right', $event)" class="scroll right" ng-disabled="scroll_clicked"></a>
             </div>
            <div class="groups" ng-class="width > 992 ?  'mb-scroll' : ''" ng-style="groupHeight()">
                <div ng-show="selectedVenueIds" class="heading hidden-xs hidden-sm"><a class="text-primary" href="#" ng-click="selectedVenueIds = false; $event.preventDefault()">< All Results</a></div>
                <div ng-show="selectedVenueIds" class="heading hidden-xs hidden-sm">Venue at <strong class="text-primary">{[{ selectedVenueName }]}</strong></div>
                <div class="list-results" ng-repeat="group in everciseGroups" ng-if="group.remaining > 0" id="group-{[{group.id}]}" ng-show="!selectedVenueIds || selectedVenueIds.indexOf(group.id)>-1">
                    <div class="col-xs-6 mt10"  ng-if="view == 'grid'" ng-cloak>
                        <ul class="list-group class-block">
                             <li class="list-group-item class-img-wrapper">
                                 <a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}"><img ng-src="{[{group.image}]}" alt="{[{group.name}]}" class="img-responsive"></a>
                             </li>
                             <div class="class-body">
                                 <li class="list-group-item text-center class-title">
                                     <h4><a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}">{[{group.name | truncate:22  }]}</a></h4>
                                     <p><span id="venue-{[{group.venue.id}]}" class="icon icon-sm icon-sm-marker mr5"></span>{[{ group.venue.postcode }]}</p>
                                 </li>
                                 <li class="list-group-item class-footer">
                                     <aside class="text-center"><strong class="text-primary">{[{ group.price | currency :  '£' : 2  }]}</strong></aside>
                                     <aside class="btn-wrapper"><a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}" class="btn btn-primary btn-block">{[{ width > 500 ?  'View Class' : 'View' }]} </a></aside>
                                 </li>
                             </div>
                         </ul>
                     </div>
                    <div ng-if="view == 'list'" class="row no-gutter ml0 mr0 class-stacked" ng-class="(lastActiveMarker == group) ? 'active' : ''">
                        <div class="col-xs-9">
                            <h2 class="h4"><a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}">{[{ group.name | truncate:40 }]}</a></h2>
                            <span id="venue-{[{group.venue.id}]}" class="icon icon-sm icon-sm-marker mr5"></span><small>{[{ group.venue.name }]},{[{ group.venue.postcode }]}</small><br>
                            <div class="smallest-btn-wrapper">
                                <strong class="h5 text-large">AVAILABLE CLASSES:</strong>
                                <a ng-repeat="(time, link) in group.times | objLimitTo:3" ng-click="gaEventTrigger('Class schedule', 'click', group.name)" href="/classes/{[{ group.slug }]}?t={[{link}]}" class="ml5 mr5 btn btn-smallest btn-primary btn-rounded">{[{ time }]}</a>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="btn-group-vertical btn-block">
                                 <a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">{[{ group.price | currency :  '£' : 2  }]}</a>
                                 <a ng-click="gaEventTrigger('View Class', 'click', group.name)" href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">{[{ width > 500 ?  'View Class' : 'View' }]} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div ng-if="results.results.total < 3" class="panel-body text-center">
                    <strong class="text-larger">Sorry</strong>
                    <p>Looks like we couldn't find any more classes.<br>
                    How about trying one of these instead</p>
                    <a ng-repeat="tag in results.related_categories" href="/uk/{[{ results.url}]}?search={[{ tag }]}" class="btn btn-rounded btn-pill mb10 ml5 mr5">{[{ tag }]}</a>
                </div>
            </div>

        </div>

    </div>

    @if(Session::has('success'))
        <div class="mt10 alert alert-success alert-dismissible fixed" role="alert">
            {{ Session::get('success')  }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif


    </div>

@stop