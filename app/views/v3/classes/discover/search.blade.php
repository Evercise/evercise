@extends('v3.layouts.master')
<?php  View::share('angular', 'show') ?>
<?php  View::share('footer', 'no') ?>
@include('layouts.laracasts')

@section('body')

  <div id="angular-wrapper" ng-app="everApp" ng-controller="searchController" ng-cloak>

    @include('v3.landing.popup')

    <ui-gmap-google-map center='map.center'
        zoom="map.zoom"
        pan="true"
        options="mapOptions"
        events="mapEvents"
        draggable="true"
        control="map.control"
    >


    </ui-gmap-google-map>

    <div class="results">
        <div class="inner">
            <div class="heading"><span class="text-primary">{[{ results.size}]} {[{ results.search}]}</span> Classes found near <span class="text-primary">{[{ results.area.name }]}</span></div>
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-justified">
                  <li role="presentation"><a href="#filter" class="filter-btn" data-toggle="tab">Filter</a></li>
                  <li role="presentation"><a href="#sort" class="sort-btn" data-toggle="tab">Sort by</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="filter">
                        <div class="row mt25">
                            <div class="col-xs-10 col-xs-offset-1">
                                <strong class="h4">Class time</strong>
                                <div class="filter-slider mt25 mb15">
                                    <a href="#">All</a>
                                    <a href="#">Morning</a>
                                    <a href="#">Afternoon</a>
                                    <a href="#">Evening</a>
                                </div>
                                <strong class="h4">Distance</strong>
                                <div class="filter-slider mt25 mb25">
                                    <a href="#">1 mi</a>
                                    <a href="#">3 mi</a>
                                    <a href="#">5 mi</a>
                                    <a href="#">10 mi</a>
                                </div>
                                <div class="text-center mb20">
                                    <button class="btn btn-white-primary">Update Results</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="sort">
                        sort
                    </div>
                </div>
            </div>

            <div class="date-picker-inline">
                <div class="wrapper">
                    <div class="content">
                         <li class="date-btn" ng-repeat="(date, value) in availableDates">
                            <div class="day">{[{ date | date : 'EEE'}]}</div>
                            <a href="#">
                                {[{ date | date : 'd'}]}<span class="month">{[{ date| date : 'MMM'}]}</span>
                            </a>
                         </li>
                    </div>

                </div>

                 <a href="#"  ng-click="scroll_clicked || scrollDates('left', $event)" class="scroll left" ng-disabled="scroll_clicked" ><</a>
                 <a href="#" ng-click="scroll_clicked || scrollDates('right', $event)" class="scroll right" ng-disabled="scroll_clicked">></a>
             </div>
            <div class="groups mb-scroll" ng-style="groupHeight()">
                <div class="list-results" ng-repeat="group in everciseGroups">
                    <div class="row class-stacked">
                        <div class="col-sm-9">
                            <h2 class="h4 mt0 mb0"><a href="/classes/{[{ group.slug }]}">{[{ group.name }]}</a></h2>
                            <small>{[{ group.venue.name }]},{[{ group.venue.postcode }]}</small><br>
                            <div class="smallest-btn-wrapper">
                                <strong class="h5">AVAILABLE CLASSES:</strong>
                                <button class="ml10 mr20 btn btn-smallest btn-primary btn-rounded">8 am</button><button class="btn btn-smallest btn-primary btn-rounded">11 am</button>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="btn-group-vertical btn-block">
                                 <a href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">{[{ group.default_price | currency :  '£' : 2  }]}</a>
                                 <a href="/classes/{[{ group.slug }]}" class="btn btn-white-primary btn-block">View Class</a>
                            </div>
                        </div>
                    </div>
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