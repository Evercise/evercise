@extends('v3.layouts.master')
<?php  View::share('footer', 'no') ?>
@section('body')
    @include('v3.classes.discover.filters')

        <div class="class-snippet-wrapper side-bar">
            <div class="snippet-header">
                <strong>Your search returned <span class="text-primary">0</span> results</strong>
            </div>
            <div class="snippet-body mb-scroll">
                @include('v3.classes.class_snippet', ['active' => 'yes'])
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
                @include('v3.classes.class_snippet')
            </div>


        </div>
        @include('v3.classes.class_preview')

        <div class="map-wrapper">
            <div id="map_canvas" class="map-canvas"></div>
        </div>


    </div>



@stop