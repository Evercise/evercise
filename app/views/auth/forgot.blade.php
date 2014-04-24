@extends('layouts.master')


@section('content')
    <div id="login" class="full_width">
        {{ Form::open() }}
            @if(isset($success))
            <div class="success-msg">
                <h2>{{ $success }}</h2>
                <br>
                <h6>{{ $message }}</h6>
                <br>
                <p>{{ $action }}</p>
           </div>
           @else
            <div>
                <h2>Forgot your password?</h2>
                <h4>Don’t panic!</h4>

                <div class="input-wrapper">
                    @include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'Please confirm the email address associated with your account. We will then  email you a link to reset your password'))
                    @if ($errors->has('forgot'))
                        {{ $errors->first('forgot', '<p class="error-msg">:message</p>')}}
                    @endif
                </div>
            </div>
            <div class="btn-wrapper">
                {{ Form::submit('Retrieve Password', array('class' => 'btn-yellow')) }}
            </div>
            @endif 
        {{ Form::close() }}
    </div>
@stop