@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Step 1: Create your user account', 'subtitle'=>'You can either fill in your details below, or sign up in one click using your Facebook account.'))
    @if($referralCode)
        <div class="referral-wrapper">
            Your referral code, {{ $referralCode }}., is valid! If you sign up now you will receive 1 Evercoin!
        </div>
    @endif
    <div class="fb-wrapper">
        {{ HTML::link('login/fb', 'Sign up with facebook', array('class' => 'btn-fb')) }}
    </div>

    <div class="col10 push1">
    
    	{{ Form::open(array('id' => 'user_create', 'url' => 'users', 'method' => 'post', 'class' => 'create-form')) }}
        	@include('form.textfield', array('fieldname'=>'display_name', 'placeholder'=>'Between 5 and 20 characters', 'maxlength'=>20, 'label'=>'Choose your display_name', 'fieldtext'=>'This will be your display name visible to all Evercise members. It will also be used when you create a class.' ))
            @if ($errors->has('display_name'))
                {{ $errors->first('display_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>15, 'label'=>'Add your first name', 'fieldtext'=>'Please add your first name.' ))
            @if ($errors->has('first_name'))
                {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>15, 'label'=>'Add your last name', 'fieldtext'=>'Please add your last name.' ))
            @if ($errors->has('last_name'))
                {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.datepicker', array('fieldname'=>'dob', 'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth', 'fieldtext'=>'Please Add your date of birth.' ))
            @if ($errors->has('last_name'))
                {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
            @endif

        	@include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.'))
            @if ($errors->has('email'))
                {{ $errors->first('email', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.password', array('fieldname'=>'password', 'placeholder'=>'Choose a password', 'maxlength'=>32, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
            @include('form.phone', array('fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'fieldtext'=>'(Optional) - Your phone number will never be shared and will only be used to contact you if there is any last minute changes with your classes'))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.select', array('fieldname'=>'gender', 'label'=>'Please select your sex', 'values'=>array(1=>'Male', 2=>'Female')))
        	@include('form.checkbox', array('id' => 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))

            <div class="center-btn-wrapper" >
        	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
            </div>
            <div class="success_msg">Success, We are now directing you to you user dashboard.</div>
    	{{ Form::close() }}
    </div>

@stop