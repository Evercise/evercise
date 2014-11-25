@extends('v3.layouts.master')
@section('body')
    @include('v3.users.profile.nav')

    FUCK YOUR OWN FACE
    <div class="">

        <div id="attended" class="profile-panels">
            @include('v3.users.profile.attended_classes', ['sessions' => $data['past_sessions']])
        </div>
        <div id="upcoming" class="hidden profile-panels">
            @include('v3.users.profile.upcoming_classes', ['sessions' => $data['future_sessions']])
        </div>
        <div id="wallet" class="hidden profile-panels">
            @include('v3.users.profile.wallet')
        </div>
        <div id="edit" class="hidden profile-panels">
            @include('v3.users.profile.edit')
        </div>

    </div>
@stop