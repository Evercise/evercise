@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mt20">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb50">
                    <div class="col-sm-4">
                        {{ image( $data['user']->directory.'/medium_'.$data['user']->image , 'profile picture', [ 'class' => 'img-responsive img-circle']) }}
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
            @if( !$data['evercisegroups']->isEmpty() )
                @include('v3.users.profile.class_hub')
            @else
                <div class="container">
                    <div class="underline text-center">
                        <h1>Class Hub</h1>
                    </div>
                    <div class="well text-center">You currently have no classes, click the create a class button above to get started</div>
                </div>
            @endif
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
        <div id="edit" class="hidden profile-panels">
            @include('v3.users.profile.edit')
        </div>

    </div>
@stop