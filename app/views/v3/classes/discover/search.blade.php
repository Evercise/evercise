@extends('v3.layouts.master')
<?php  View::share('angular', 'show') ?>
<?php  View::share('footer', 'no') ?>
<?php  View::share('angularApp', 'ng-app="everApp"') ?>
@include('layouts.laracasts')

@section('body')

  <div id="angular-wrapper"  ng-controller="searchController" ng-cloak>

    @include('v3.landing.popup')

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

    </ui-gmap-google-map>

    <div class="results">

        <div class="inner">
            <div ng-if="resultsLoading" class="mask"><div class="loading"></div></div>
            <div class="heading"><span class="text-primary">{[{ results.results.total }]} {[{ results.search}]}</span> Classes found near <span class="text-primary">{[{ results.area.name }]}</span></div>
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-justified">
                  <li role="presentation"><a href="#filter" class="filter-btn" data-toggle="tab">Filter</a></li>
                  <li role="presentation"><a href="#sort" class="sort-btn" data-toggle="tab">Sort by</a></li>
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
                                    <a href="#" ng-class="(results.radius == '1mi') ? 'active' : ''" ng-click="results.radius = '1mi'; $event.preventDefault(); getData();">1 mi</a>
                                    <a href="#" ng-class="(results.radius == '3mi') ? 'active' : ''" ng-click="results.radius = '3mi'; $event.preventDefault();getData();">3 mi</a>
                                    <a href="#" ng-class="(results.radius == '5mi') ? 'active' : ''" ng-click="results.radius = '5mi'; $event.preventDefault();getData();">5 mi</a>
                                    <a href="#" ng-class="(results.radius == '10mi') ? 'active' : ''" ng-click="results.radius = '10mi'; $event.preventDefault();getData();">10 mi</a>
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

            <div ng-if="selectedDate" class="date-picker-inline">
                <div class="wrapper">
                    <div class="content">
                         <li class="date-btn" ng-repeat="(date, value) in availableDates" ng-class="(date == selectedDate) ? 'active' : ''">
                            <div class="day">{[{ date | date : 'EEE'}]}</div>
                            <a href="#" ng-click="changeSelectedDate($event, date)">
                                {[{ date | date : 'd'}]}<span class="month">{[{ date| date : 'MMM'}]}</span>
                            </a>
                         </li>
                    </div>

                </div>

                 <a href="#"  ng-click="scroll_clicked || scrollDates('left', $event)" class="scroll left" ng-disabled="scroll_clicked" ><</a>
                 <a href="#" ng-click="scroll_clicked || scrollDates('right', $event)" class="scroll right" ng-disabled="scroll_clicked">></a>
             </div>

            <div class="groups mb-scroll" ng-style="groupHeight()">
                <div ng-show="selectedVenueIds" class="heading"><a class="text-primary" href="#" ng-click="selectedVenueIds = false; $event.preventDefault()">< All Results</a></div>
                <div ng-show="selectedVenueIds" class="heading">Venue at <strong class="text-primary">{[{ selectedVenueName }]}</strong></div>
                <div class="list-results" ng-repeat="group in everciseGroups track by group.id" id="group-{[{group.id}]}" ng-show="!selectedVenueIds || selectedVenueIds.indexOf(group.id)>-1">
                    <div class="row class-stacked" ng-class="(lastActiveMarker == group) ? 'active' : ''">
                        <div class="col-sm-9">
                            <h2 class="h4"><a href="/classes/{[{ group.slug }]}">{[{ group.name | truncate:40 }]}</a></h2>
                            <span id="venue-{[{group.venue.id}]}" class="icon icon-sm icon-sm-marker mr5"></span><small>{[{ group.venue.name }]},{[{ group.venue.postcode }]}</small><br>
                            <div ng-if="selectedDate" class="smallest-btn-wrapper">
                                <strong class="h5 text-large">AVAILABLE CLASSES:</strong>
                                <a ng-repeat="(time, link) in group.times" href="/classes/{[{ group.slug }]}?t={[{link}]}" class="ml5 mr5 btn btn-smallest btn-primary btn-rounded">{[{ time }]}</a>
                            </div>
                            <div ng-if="!selectedDate" class="smallest-btn-wrapper">
                                <strong class="h5 text-large">UPCOMING CLASSES:</strong>
                                <div  ng-repeat="session in group.futuresessions | limitTo:3">
                                    <span>{[{ session.date_time }]} - {[{session.remaining }]} tickets left</span>
                                </div>
                                <a class="link" href="/classes/{[{ group.slug }]}" ng-if="group.futuresessions.length > 3">{[{ group.futuresessions.length - 3}]} dates more</a>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="btn-group-vertical btn-block">
                                 <a href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">{[{ group.price | currency :  '£' : 2  }]}</a>
                                 <a href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">View Class</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div ng-if="!selectedDate" class="panel-body text-center">
                    <strong class="text-larger">Sorry</strong>
                    <p>Looks like we couldn't find any more classes.<br>
                    How about trying one of these instead</p>
                    <a ng-repeat="tag in results.related_categories" href="/uk/{[{ results.url}]}?search={[{ tag }]}" class="btn btn-rounded btn-white-primary mb10 ml5 mr5">{[{ tag }]}</a>
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