@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb50">
                    <div class="col-sm-4">
                        {{ image( $data['trainer']->user->directory.'/medium_'.$data['trainer']->user->image , 'profile picture', [ 'class' => 'img-responsive img-circle']) }}
                    </div>
                    <div class="col-sm-8 mt20">
                        <h1 class="h3">{{ $data['trainer']->user->first_name .' '. $data['trainer']->user->last_name }}<br><small>{{ $data['trainer']->user->display_name }}</small></h1>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 ">
                {{ $data['trainer']->bio }}
            </div>
        </div>
    </div>
    <hr>
    <!--
    <div id="profile-nav" class="sticky-wrapper">
        <nav id="user-nav-bar" class="navbar navbar-default mb0 sticky-fixed-nav" role="navigation">
            <div class="container">
                <ul class="nav nav-pills nav-justified">
                    <li class="{{ ($tab === 0 ? 'active' : ($tab === 'classes' ? 'active' : null)) }}"><a href="#classes">Classes</a></li>
                    <li class="{{ $tab === 'activity' ? 'active' : null }}"><a href="#activity">Activity</a></li>
                    <li class="{{ $tab === 'reviews' ? 'active' : null }}"><a href="#reviews">Reviews</a></li>
                </ul>
            </div>
        </nav>
    </div>
    -->
    <div id="classes" class="{{ ($tab === 0 ? 'profile-panels' : ($tab === 'classes' ? 'profile-panels' : 'profile-panels hidden')) }}">
         @include('v3.users.profile.class_hub', ['groups' => $data['evercisegroups'], 'mode' => 'user'])
    </div>
    <div id="activity" class="{{ $tab === 'activity' ? 'profile-panels' : 'hidden profile-panels' }}">
         actiivity
    </div>
    <div id="reviews" class="{{ $tab === 'reviews' ? 'profile-panels' : 'hidden profile-panels' }}">
         reviews
    </div>
@stop