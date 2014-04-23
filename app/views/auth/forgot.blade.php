@extends('layouts.master')


@section('content')
    <div id="login" class="login">
    Forgot Password

        {{ Form::open() }}

            @if ($errors->has('forgot'))
                    <div class="alert alert-error">{{ $errors->first('forgot', ':message') }}</div>
            @endif

            <div class="control-group">
                {{ Form::label('email', 'Email') }}
                <div class="controls">
                        {{ Form::text('email') }}
                </div>
            </div>

            <div class="forgot-password">
                    {{ Form::submit('Retrieve Password', array('class' => 'btn-login')) }}
            </div>
        {{ Form::close() }}
    </div>
@stop