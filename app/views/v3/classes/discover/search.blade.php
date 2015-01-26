@extends('v3.layouts.angular-master')

<?php  View::share('footer', 'no') ?>

@section('body')

  <div id="angular" ng-controller="searchController" ng-cloak>
    @include('v3.classes.discover.filters')
    @include('v3.landing.popup')

    @include('v3.classes.discover.search_wrapper')

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