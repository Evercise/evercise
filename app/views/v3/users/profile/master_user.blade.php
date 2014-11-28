@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb50">
                    <div class="col-sm-4">
                        @if(!empty($data['user']->image))
                            {{ image( $data['user']->directory.'/medium_'.$data['user']->image , 'profile picture', [ 'class' => 'img-responsive img-circle']) }}
                        @else
                            {{ image( 'assets/img/'.($data['user']->gender == 1 ? 'male.png':'female.png') , 'profile picture', [ 'class' => 'img-responsive img-circle']) }}
                        @endif
                    </div>
                    <div class="col-sm-8 mt20">
                        <h3>{{ $data['user']->first_name .' '. $data['user']->last_name }}<br><small>{{ $data['user']->display_name }}</small></h3>
                    </div>
                    <a href="/auth/logout">Log out</a>
                </div>

            </div>
        </div>
    </div>
    @include('v3.users.profile.nav')

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