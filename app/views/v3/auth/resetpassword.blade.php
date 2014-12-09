@extends('v3.layouts.master')

@section('body')
    <div class="container first-container">
        {{ Form::open(array('id' => 'passwords_reset', 'url' => 'users/resetpassword', 'method' => 'post')) }}
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    @if ($errors->has('forgot'))
                        <div class="mt10 alert alert-danger" role="alert">
                            <div class="error-msg">{{ $errors->first('forgot', ':message') }}</div>
                        </div>
                    @endif
                    @if (isset($message))
                        <div class="mt10 alert alert-danger" role="alert">
                            <div class="error-msg">{{ $message }}</div>
                        </div>
                    @else
                        <div class="row text-center mb40">
                            <div class="underline">
                                <h1>Reset your password</h1>
                            </div>
                        </div>
                        <div class="form-group mb30">
                            {{ Form::label('email', 'Your email address', 'form-control') }}
                            {{ Form::text('email', null, ['placeholder'=>'Type your current email address here', 'maxlength'=> 50, 'class' => 'form-control']) }}
                            @if ($errors->has('email'))

                                <div class="row">
                                    <div class="mt10 alert alert-danger" role="alert">
                                          {{ $errors->first('email', '<p>:message</p>')}}
                                      </div>
                                </div>
                            @endif
                            <p>Please confirm the email address associated with your account.</p>
                        </div>
                        <div class="form-group mb30">
                            {{ Form::label('password', 'Create your password', 'form-control') }}
                            {{ Form::password('password', ['placeholder'=>'Choose a password', 'maxlength'=> 50, 'class' => 'form-control']) }}
                            @if ($errors->has('password'))

                                <div class="row">
                                    <div class="mt10 alert alert-danger" role="alert">
                                          {{ $errors->first('password', '<p>:message</p>')}}
                                      </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb30">

                            {{ Form::label('password_confirmation', 'Confirm your password', 'form-control') }}
                            {{ Form::password('password_confirmation', ['placeholder'=>'Choose a password', 'maxlength'=> 50, 'class' => 'form-control']) }}
                            @if ($errors->has('password_confirmation'))

                                <div class="row">
                                    <div class="mt10 alert alert-danger" role="alert">
                                          {{ $errors->first('password_confirmation', '<p>:message</p>')}}
                                      </div>
                                </div>
                            @endif
                        </div>
                        @include('form.hidden', array('fieldname'=>'code', 'value'=>$code))
                        <div class="text-center mb40">
                            {{ Form::submit('Reset Password', array('class' => 'btn btn-primary')) }}
                        </div>
                    @endif
                </div>
            </div>
        {{ Form::close() }}
    </div>

@stop