@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb50">
                    <div class="col-sm-4">
                        <img src="{{url().'/profiles/'.$data['user']->directory.'/'.$data['user']->image}}" alt="profile picture" class="img-responsive img-circle">
                    </div>
                    <div class="col-sm-8 mt20">
                        <h3>{{ $data['user']->first_name .' '. $data['user']->last_name }}<br><small>{{ $data['user']->display_name }}</small></h3>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 text-right mt50">
                {{ HTML::linkRoute('evercisegroups.create', 'Create a new class', null, ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
    @include('v3.trainers.profile.nav')


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