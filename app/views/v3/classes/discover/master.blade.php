@extends('v3.layouts.angular-master')
@include('layouts.laracasts')
<?php  View::share('footer', 'no') ?>

@section('body')
  <div id="angular" ng-app="DiscoverApp" ng-controller="DiscoverController">
    @include('v3.classes.discover.filters')

    @include('v3.angular.angular-view')


    </div>



@stop