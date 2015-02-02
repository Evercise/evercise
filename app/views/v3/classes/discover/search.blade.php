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
        <div class="heading"><span class="text-primary">200 Yoga</span> Classes found in <span class="text-primary">Holloway</span></div>
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
        <ul class="date-picker-inline">
            <a href="#" class="scroll left"><</a>
            <a href="#" class="scroll right">></a>
            <li class="date-btn active">
                <div class="day">Mon</div>
                <a href="#">
                    28<span class="month">JAN</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Tue</div>
                <a href="#">
                    29<span class="month">JAN</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Wed</div>
                <a href="#">
                    30<span class="month">JAN</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Thu</div>
                <a href="#">
                    31<span class="month">JAN</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Fri</div>
                <a href="#">
                    1<span class="month">FEB</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Sat</div>
                <a href="#">
                    2<span class="month">FEB</span>
                </a>
            </li>
            <li class="date-btn">
                <div class="day">Sun</div>
                <a href="#">
                    3<span class="month">FEB</span>
                </a>
            </li>
        </ul>
        <div class="list-results">
            <div class="row class-stacked">
                <div class="col-sm-9">
                    <h2 class="h4 mt0 mb0">Morning Yoga Class</h2>
                    <small>Gentle Gym, SE1</small><br>
                    <div class="smallest-btn-wrapper">
                        <strong class="h5">AVAILABLE CLASSES:</strong>
                        <button class="ml10 mr20 btn btn-smallest btn-primary btn-rounded">8 am</button><button class="btn btn-smallest btn-primary btn-rounded">11 am</button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group-vertical btn-block">
                         <button class="btn btn-white-primary btn-block">£10</button>
                         <button class="btn btn-white-primary btn-block">View Class</button>
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