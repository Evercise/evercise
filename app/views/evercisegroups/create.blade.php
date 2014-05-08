@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Add the information about your class', 'subtitle'=>'Make it as relevant and interesting as possible'))
    <div id="upload_wrapper">
         @include('image.upload-form', array('uploadImage' => null, 'label' => 'Upload you classes image'))
    </div>

	{{ Form::open(array('id' => 'evercisegroup_create', 'url' => 'evercisegroups', 'method' => 'post', 'class' => 'create-form')) }}


        @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Maximum 30 Characters', 'maxlength'=>30, 'label'=>'Class Name', 'fieldtext'=>'Your class name should be simple, specific and memorable, and it should clarify the nature of the service you are going to provide. Try not to be too general.' ))
        @if ($errors->has('classname'))
            {{ $errors->first('classname', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'description', 'placeholder'=>'Maximum 500 Characters', 'maxlength'=>100, 'label'=>'Class description', 'fieldtext'=>'This summary will appear in the Class Panel under the title. Use your words wisely to explain as concisely and clearly as possible what a participant can hope to gain from joining your class.' ))
        @if ($errors->has('summary'))
            {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.select', array('fieldname'=>'category', 'label'=>'Category', 'values'=>$categories))
        @if ($errors->has('category'))
            {{ $errors->first('category', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'summary', 'placeholder'=>'Maximum 100 Characters', 'maxlength'=>100, 'label'=>'Brief Summary', 'fieldtext'=>'This will be visible on the class page. Here you have a bit more room to describe the details of your class. You could explain what a participant will be expected to do and what they can expect to gain, suggest suitable clothing, list the facilities available at the venue (e.g. changing room, shower), mention the difficulty level etc' ))
        @if ($errors->has('summary'))
            {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'0', 'maxlength'=>5, 'label'=>'Class Duration', 'fieldtext'=>'Use the slider to input the duration of your class' ))
        @if ($errors->has('duration'))
            {{ $errors->first('duration', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'1', 'maxlength'=>5, 'label'=>'Maximum Class Size', 'fieldtext'=>'Use the slider to select the maximum number of participants you are willing to have in your class.' ))
        @if ($errors->has('maxsize'))
            {{ $errors->first('maxsize', '<p class="error-msg">:message</p>')}}
        @endif

        LOCATION

        @include('form.slider', array('fieldname'=>'price', 'placeholder'=>'10', 'maxlength'=>5, 'label'=>'Class Price', 'fieldtext'=>'Use the slider to input the price you want to charge each participant for your class.' ))
        @if ($errors->has('price'))
            {{ $errors->first('price', '<p class="error-msg">:message</p>')}}
        @endif


        {{ Form::hidden( 'thumbFilename' , basename($displayImage), array('id' => 'thumbFilename')) }}
        
        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>

	        <div class="success_msg">Success!</div>

    {{ Form::close() }}
        


@stop