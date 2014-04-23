@extends('layouts.master')


@section('content')
    <div id="login" class="login">
        {{ Form::open() }}

            @if ($errors->has('login'))
                    <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
            @endif

            <div>
                {{ Form::label('email', 'Email') }}
                <div>
                        {{ Form::text('email') }}
                </div>
            </div>

            <div>
                {{ Form::label('password', 'Password') }}
                <div>
                        {{ Form::password('password') }}
                </div>
            </div>

            <di>
                    {{ Form::submit('Login', array('class' => 'btn-yellow')) }}
            </div>


        {{ Form::close() }}
    </div>
@stop