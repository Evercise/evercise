@extends('layouts.master')


@section('content')
    <div id="login" class="login">
        Reset Password

        {{ Form::open() }}

            @if ($errors->has('forgot'))
                    <div class="alert alert-error">{{ $errors->first('forgot', ':message') }}</div>
            @endif
            @if (isset($message))
                    <div class="alert alert-error">{{ $message }}</div>
            @else
                @include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'Please confirm the email address associated with your account.'))
                @if ($errors->has('email'))
                    {{ $errors->first('email', '<p class="error_msg">:message</p>')}}
                @endif

                @include('form.password', array('fieldname'=>'password', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
                @if ($errors->has('password'))
                    {{ $errors->first('password', '<p class="error_msg">:message</p>')}}
                @endif

                @include('form.hidden', array('fieldname'=>'code', 'value'=>$code))


                <div class="forgot-password">
                        {{ Form::submit('Reset Password', array('class' => 'btn-login')) }}
                </div>
            @endif
        {{ Form::close() }}
    </div>
@stop