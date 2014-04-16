@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Step 1: Create your user account', 'subtitle'=>'You can either fill in your details below, or sign up in one click using your Facebook account.'))

	{{ Form::open(array('id' => 'user_create', 'url' => 'users', 'method' => 'post')) }}
    	@include('form.textfield', array('fieldname'=>'userName', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Choose your username', 'fieldtext'=>'This will be your display name visible to all Evercise members. It will also be used when you create a class.' ))
        @if ($errors->has('userName'))
            {{ $errors->first('userName', '<p class="error_msg">:message</p>')}}
        @endif
    	@include('form.textfield', array('fieldname'=>'userEmail', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.'))
        @if ($errors->has('userEmail'))
            {{ $errors->first('userEmail', '<p class="error_msg">:message</p>')}}
        @endif
    	@include('form.password', array('fieldname'=>'userPassword', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
        @if ($errors->has('userPassword'))
            {{ $errors->first('userPassword', '<p class="error_msg">:message</p>')}}
        @endif
    	@include('form.select', array('fieldname'=>'userSex', 'label'=>'Please select your sex'))
    	@include('form.checkbox', array('id' => 'userNewsletter','testparam'=>'not default', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))

    	
    	
    	

    	{{ Form::submit('Sign Up' , array('class'=>'btn')) }}
	{{ Form::close() }}
@stop