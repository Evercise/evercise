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
        <ul class="nav nav-tabs nav-justified">
          <li role="presentation"><a href="#">Home</a></li>
          <li role="presentation"><a href="#">Profile</a></li>
        </ul>
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