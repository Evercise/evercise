@extends('v3.layouts.master')


@section('body')
    <div class="container first-container">
        {{ Form::open() }}
            @if(isset($success))
                <div class="row">
                    <div class="mt10 alert alert-success alert-dismissible" role="alert">
                          <h2>{{ $success }}</h2>
                          <br>
                          <h6>{{ $message }}</h6>
                          <br>
                          <p>{{ $action }}</p>
                          <button type="button" class="close" data-dismiss="alert">
                              <span aria-hidden="true">&times;</span>
                              <span class="sr-only">Close</span>
                          </button>
                      </div>
                </div>
            @else
                <div class="row text-center mb40">
                    <div class="underline">
                        <h1>Forgot your password?</h1>
                    </div>
                    <strong>Don’t panic!</strong>
                </div>
                <div class="row mb40">
                    <div class="col-sm-8 col-sm-offset-2">
                        {{ Form::label('email', 'Your email address', 'form-control') }}
                        {{ Form::text('email', null, ['placeholder'=>'Type your current email address here', 'maxlength'=> 50, 'class' => 'form-control']) }}
                        @if ($errors->has('forgot'))
                            <div class="row">
                                <div class="mt10 alert alert-danger" role="alert">
                                      {{ $errors->first('forgot', '<p>:message</p>')}}
                                  </div>
                            </div>
                            {{ $errors->first('forgot', '<p class="error-msg">:message</p>')}}
                        @endif
                        <p>Please confirm the email address associated with your account. We will then  email you a link to reset your password</p>
                        <div class="text-center">
                            {{ Form::submit('Retrieve Password', ['class' => 'btn btn-primary']) }}
                        </div>

                    </div>
                </div>
            @endif
        {{ Form::close() }}
    </div>

@stop