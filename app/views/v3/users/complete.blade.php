@extends('v3.layouts.master')
@section('body')
    <div class="container first-container text-center mb50">
        <div class="row">
            <div class="underline">
                <h1>Registration complete</h1>
            </div>
            <strong>Hey <span class="text-primary">{{ $user->display_name }}</span> You&apos;re now ready to get started creating or browsing classes on Evercise!</strong>
            <div class="col-sm-4 col-sm-offset-4 mt50 mb50">
                <div class="row">
                    <div class="col-sm-6">
                        {{HTML::linkRoute('evercisegroups.search', 'Browse classes' , null, ['class' =>'btn btn-primary btn-block' ])}}
                    </div>
                    <div class="col-sm-6">
                        {{HTML::linkRoute('users.edit', 'Go to Account' , $user->id , ['class' =>'btn btn-primary btn-block' ])}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ ga('/users/create') }}
@stop