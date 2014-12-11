@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20 md-text-center">
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
                    <a href="{{ URL::route('auth.logout') }}">Log out</a>
                </div>

            </div>
            <div class="col-sm-6 text-right mt50">
                {{ HTML::linkRoute('trainers.create', 'Become a trainer', null, ['class' => 'btn btn-info']) }}
                @if($data['user']->hasAccess('admin'))
                    {{ HTML::linkRoute('admin.dashboard', 'Admin', null, ['class' => 'btn btn-success']) }}
                @endif
            </div>
        </div>
    </div>
    @include('v3.users.profile.nav')

    <div class="">

        <div id="attended" class="{{ ($tab === 0 ? 'profile-panels' : ($tab === 'attended' ? 'profile-panels' : 'profile-panels hidden')) }}">
            @include('v3.users.profile.attended_classes', ['sessions' => $data['past_sessions']])
        </div>
        <div id="upcoming" class="{{ $tab === 'upcoming' ? 'profile-panels' : 'hidden profile-panels' }}">
            @include('v3.users.profile.upcoming_classes', ['sessions' => $data['future_sessions']])
        </div>
        <div id="activity" class="{{ $tab === 'activity' ? 'profile-panels' : 'hidden profile-panels' }}">
            @include('v3.users.profile.activity')
        </div>
        <div id="wallet" class="{{ $tab === 'wallet' ? 'profile-panels' : 'hidden profile-panels' }}">
            @include('v3.users.profile.wallet')
        </div>
        <div id="edit" class="{{ $tab === 'edit' ? 'profile-panels' : 'hidden profile-panels' }}">
            @include('v3.users.profile.edit')
        </div>


    </div>
@stop