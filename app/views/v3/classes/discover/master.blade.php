@extends('v3.layouts.master')
<?php  View::share('footer', 'no') ?>
@section('body')
    @include('layouts.laracasts')
    <div ng-app="DiscoverApp" ng-controller="DiscoverController">
    @include('v3.classes.discover.filters')
        <div id="class-preview-wrapper">

           {{--
           @foreach($evercisegroups as $key => $class)
                 @include('v3.classes.class_preview', ['class' => $class ])
            @endforeach
            --}}
        </div>
        <div class="class-snippet-wrapper side-bar">
            <div class="snippet-header">
                <strong>Your search returned <span class="text-primary">0</span> results</strong>

            </div>
            <div class="snippet-body mb-scroll">
                @include('v3.angular.snippet-template')
                {{--
                @foreach($evercisegroups as $key => $class)
                     @include('v3.classes.class_snippet', [ 'class' => $class])
                @endforeach
                --}}
            </div>


        </div>

        <div class="map-wrapper">
            @include('v3.angular.map-template')
        </div>


    </div>



@stop