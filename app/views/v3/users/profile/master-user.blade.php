@extends('v3.layouts.master')
@section('body')
    @include('v3.users.profile.nav')


    <div class="first-container">

        <div id="attended" class="profile-panels">
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