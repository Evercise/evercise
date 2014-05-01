@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Become a Trainer', 'subtitle'=>'Fill in your details below.'))

    
	{{ Form::open(array('id' => 'trainer_create', 'url' => 'trainers', 'method' => 'post')) }}

        @include('form.select', array('fieldname'=>'discipline', 'label'=>'discipline', 'values'=>$disciplines))
        @if ($errors->has('discipline'))
            {{ $errors->first('discipline', '<p class="error-msg">:message</p>')}}
        @endif
    	@include('form.select', array('fieldname'=>'title', 'label'=>'title', 'values'=>array('0'=>'Select a discipline')))
        @if ($errors->has('title'))
            {{ $errors->first('title', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'bio', 'placeholder'=>'write some stuff', 'maxlength'=>20, 'label'=>'Add your bio', 'fieldtext'=>'Please add some stuff about yourself' ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>20, 'label'=>'Add your website', 'fieldtext'=>'Please add your web address' ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>
        <div class="success_msg">Success!</div>
	{{ Form::close() }}

@stop