@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Add the information about your class', 'subtitle'=>'Make it as relevant and interesting as possible'))
    <div id="upload_wrapper">
        @include('widgets.upload-form', array('uploadImage' => null, 'label' => 'Upload you class image', 'fieldtext'=>'Choose a suitable image to represent your class'))
    </div>

	{{ Form::open(array('id' => 'evercisegroup_create', 'url' => 'evercisegroups', 'method' => 'post', 'class' => 'create-form')) }}


        @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Between 5 and 30 characters', 'maxlength'=>30, 'label'=>'Class Name', 'fieldtext'=>'Your class name should be simple, specific and memorable, and it should clarify the nature of the service you are going to provide. Try not to be too general.' ))
        @if ($errors->has('classname'))
            {{ $errors->first('classname', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 500 characters', 'maxlength'=>500, 'label'=>'Class description', 'fieldtext'=>'This summary will appear in the Class Panel under the title. Use your words wisely to explain as concisely and clearly as possible what a participant can hope to gain from joining your class.' ))
        @if ($errors->has('summary'))
            {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.select', array('fieldname'=>'category', 'label'=>'Category', 'values'=>$categories))
        @if ($errors->has('category'))
            {{ $errors->first('category', '<p class="error-msg">:message</p>')}}
        @endif

        @include('widgets.mapForm', array('label'=>'Class Location','fieldname1'=>'number', 'placeholder1'=>'House number', 'maxlength1'=>5, 'fieldname2'=>'street', 'placeholder2'=>'Street Name', 'maxlength2'=>50, 'fieldname3'=>'city', 'placeholder3'=>'City', 'maxlength3'=>50, 'fieldname4'=>'postcode', 'placeholder4'=>'Post Code', 'maxlength4'=>10, 'fieldtext'=>'Enter the location of your class and make sure the marker appears in the correct place on the map above. (You can drag the marker to the correct place if it doesn&apos;t match up)' ))


        @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'Between 20 and 240 mins', 'maxlength'=>3, 'label'=>'Class Duration', 'fieldtext'=>'Use the slider to input the duration of your class' ))
        @if ($errors->has('duration'))
            {{ $errors->first('duration', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'Between 1 and 100', 'maxlength'=>3, 'label'=>'Maximum Class Size', 'fieldtext'=>'Use the slider to select the maximum number of participants you are willing to have in your class.' ))
        @if ($errors->has('maxsize'))
            {{ $errors->first('maxsize', '<p class="error-msg">:message</p>')}}
        @endif

        
        @include('layouts.slider', array('fieldname'=>'price', 'placeholder'=>'Between 1 and 120 pounds', 'maxlength'=>6, 'label'=>'Class Price', 'fieldtext'=>'Use the slider to input the price you want to charge each participant for your class.' ))
        @if ($errors->has('price'))
            {{ $errors->first('price', '<p class="error-msg">:message</p>')}}
        @endif


        {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        
        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>

	        <div class="success_msg">Success!</div>

    {{ Form::close() }}
        


@stop