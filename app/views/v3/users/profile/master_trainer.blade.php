@extends('v3.layouts.master')
@section('body')

    <div class="container first-container mt20">
        <div class="row">
            <div class="col-md-6 ">
                <div class="row mb50">
                    <div class="col-md-4">
                        {{ image( $data['user']->directory.'/medium_'.$data['user']->image , 'profile picture', [ 'class' => 'img-responsive img-circle center-block']) }}
                    </div>
                    <div class="col-md-8 mt20 md-text-center">
                        <h3>{{ $data['user']->first_name .' '. $data['user']->last_name }}<br></h3><p><strong>{{ $data['user']->display_name }}</strong></p>
                        <a href="/auth/logout">Log out</a>
                    </div>

                </div>

            </div>
            <div class="col-md-6 text-right mt50 md-text-center sm-mb20">
                {{ HTML::linkRoute('evercisegroups.create', 'Create a new class', null, ['class' => 'btn btn-primary']) }}
                 @if($data['user']->hasAccess('admin'))
                    {{ HTML::linkRoute('admin.dashboard', 'Admin', null, ['class' => 'btn btn-success']) }}
                @endif

            </div>
        </div>
    </div>
    @include('v3.trainers.profile.nav')


    <div class="">

        <div id="hub" class="{{ ($tab === 0 ? 'profile-panels' : ($tab === 'hub' ? 'profile-panels' : 'profile-panels hidden')) }}">
            @if( !$data['trainer_groups']->isEmpty() )
                @include('v3.users.profile.class_hub', ['groups' => $data['trainer_groups']])
            @else
                <div class="container text-center">
                    <div class="underline text-center">
                        <h1>Class Hub</h1>
                    </div>
                    <strong>Hey <span class="text-primary">{{ $user->display_name }}</span> You currently have no classes, click the create a class button above to get started!</strong>
                </div>
            @endif
        </div>
        <div id="attended" class="{{ $tab === 'attended' ? 'profile-panels' : 'hidden profile-panels' }}">
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
            @include('v3.trainers.profile.edit')
        </div>
        <div id="password" class="{{ $tab === 'password' ? 'profile-panels' : 'hidden profile-panels' }}">
            @include('v3.users.profile.change_password')
        </div>

    </div>
@stop