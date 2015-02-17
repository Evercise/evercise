@extends('v3.layouts.master')
<?php  View::share('footer', 'no') ?>
@section('body')
    @include('v3.classes.discover.filters')
     <div class="container-fluid bg-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt10 mb20">
                    <strong>Your search return <span class="text-primary">0</span> results</strong>
                </div>
                <div class="col-sm-12">
                    @include('v3.classes.class_list')
                </div>
            </div>
        </div>
     </div>



@stop