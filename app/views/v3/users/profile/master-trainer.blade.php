@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb50">
                    <div class="col-sm-4">
                        <img src="/img/lewis.jpg" alt="profile picture" class="img-responsive img-circle">
                    </div>
                    <div class="col-sm-8 mt20">
                        <h3>Lewis Bayfield<br><small>LewisB</small></h3>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 text-right mt50">
                <a href="#" class="btn btn-primary">Create a new class</a>
            </div>
        </div>
    </div>
    @include('v3.users.profile.nav')


    <div class="">

        <div id="hub" class="profile-panels">
            @include('v3.users.profile.class_hub')
        </div>
        <div id="attended" class="hidden profile-panels">
            @include('v3.users.profile.attended_classes')
        </div>
        <div id="upcoming" class="hidden profile-panels">
            @include('v3.users.profile.upcoming_classes')
        </div>
        <div id="wallet" class="hidden profile-panels">
            @include('v3.users.profile.wallet')
        </div>

    </div>
@stop