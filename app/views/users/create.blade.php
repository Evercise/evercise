@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Step 1: Create your user account', 'subtitle'=>'You can either fill in your details below, or sign up in one click using your Facebook account.'))

	{{ Form::open(array('id' => 'user_create', 'url' => 'users', 'method' => 'post')) }}
    	@include('form.textfield', array('fieldname'=>'displayName', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Choose your displayName', 'fieldtext'=>'This will be your display name visible to all Evercise members. It will also be used when you create a class.' ))
        @if ($errors->has('displayName'))
            {{ $errors->first('displayName', '<p class="error_msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Add your first name', 'fieldtext'=>'Please add your first name.' ))
        @if ($errors->has('first_name'))
            {{ $errors->first('first_name', '<p class="error_msg">:message</p>')}}
        @endif

         @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Add your last name', 'fieldtext'=>'Please add your last name.' ))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error_msg">:message</p>')}}
        @endif

    	@include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.'))
        @if ($errors->has('email'))
            {{ $errors->first('email', '<p class="error_msg">:message</p>')}}
        @endif
    	@include('form.password', array('fieldname'=>'password', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error_msg">:message</p>')}}
        @endif
    	@include('form.select', array('fieldname'=>'gender', 'label'=>'Please select your sex'))
    	@include('form.checkbox', array('id' => 'userNewsletter','testparam'=>'not default', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))

    	
    	
    	

    	{{ Form::submit('Sign Up' , array('class'=>'btn')) }}
	{{ Form::close() }}
@stop