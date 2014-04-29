@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Become a Trainer', 'subtitle'=>'Fill in your details below.'))

    
	{{ Form::open(array('id' => 'user_create', 'url' => 'users', 'method' => 'post')) }}

    	@include('form.select', array('fieldname'=>'gender', 'label'=>'Profession', 'values'=>$professions))

         @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'contact number', 'maxlength'=>20, 'label'=>'Add your contact number', 'fieldtext'=>'Please add a contact number' ))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>
        <div class="success_msg">Success, Please check your inbox for a validation email.</div>
	{{ Form::close() }}

@stop