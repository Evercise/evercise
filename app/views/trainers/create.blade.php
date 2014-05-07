@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Become a Trainer', 'subtitle'=>'Fill in your details below.'))
    <div id="upload_wrapper">
        @include('image.upload-form')
        {{ Form::open(array('id' => 'trainer_create', 'url' => 'trainers', 'method' => 'post', 'class' => 'create-form')) }}
        @include('form.select', array('fieldname'=>'discipline', 'label'=>'Discipline', 'values'=>$disciplines))
        @if ($errors->has('discipline'))
            {{ $errors->first('discipline', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.select', array('fieldname'=>'title', 'label'=>'Title', 'values'=>array('0'=>'Select a discipline')))
        @if ($errors->has('title'))
            {{ $errors->first('title', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'bio', 'placeholder'=>'write some stuff', 'maxlength'=>500, 'label'=>'Add your bio', 'fieldtext'=>'Please add some stuff about yourself' ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>20, 'label'=>'Add your website', 'fieldtext'=>'(Optional) - Please add your web address' ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        {{ Form::hidden( 'thumbFilename' , basename($displayImage), array('id' => 'thumbFilename')) }}
       

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>
        {{ Form::close() }}
        


@stop