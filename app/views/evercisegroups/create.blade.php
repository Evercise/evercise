@extends('layouts.master')


@section('content')


	@include('layouts.pagetitle', array('title'=>'Add the information about your class', 'subtitle'=>'Make it as relevant and interesting as possible'))
    <div class="col10 push1">
        <div id="upload_wrapper">
            @if(Session::has('image_full'))
                @include('widgets.upload-form', array('uploadImage' => Session::get('image_full') , 'label' => 'Upload you class image', 'fieldtext'=>'Choose a suitable image to represent your class'))
            @else
                @include('widgets.upload-form', array('uploadImage' => null, 'label' => 'Upload you class image', 'fieldtext'=>'Choose a suitable image to represent your class'))
            @endif
        </div>

        {{-- @include('layouts.venue') --}}

    	{{ Form::open(array('id' => 'evercisegroup_create', 'url' => 'evercisegroups', 'method' => 'post', 'class' => 'create-form')) }}


            @if(Session::has('name'))
                @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Between 5 and 30 characters', 'maxlength'=>30, 'label'=>'Class Name', 'fieldtext'=>'Your class name should be simple, specific and memorable, and it should clarify the nature of the service you are going to provide. Try not to be too general.', 'default' => Session::get('name') ))
            @else
                @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Between 5 and 30 characters', 'maxlength'=>30, 'label'=>'Class Name', 'fieldtext'=>'Your class name should be simple, specific and memorable, and it should clarify the nature of the service you are going to provide. Try not to be too general.' ))
            @endif

            @if ($errors->has('classname'))
                {{ $errors->first('classname', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('description'))
                @include('form.textfield', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 500 characters', 'maxlength'=>500, 'label'=>'Class description', 'fieldtext'=>'This summary will appear in the Class Panel under the title. Use your words wisely to explain as concisely and clearly as possible what a participant can hope to gain from joining your class.', 'default' => Session::get('description') ))
            @else
                @include('form.textfield', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 500 characters', 'maxlength'=>500, 'label'=>'Class description', 'fieldtext'=>'This summary will appear in the Class Panel under the title. Use your words wisely to explain as concisely and clearly as possible what a participant can hope to gain from joining your class.' ))
            @endif

            @if ($errors->has('summary'))
                {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('category'))
                @include('form.select', array('fieldname'=>'category', 'label'=>'Category', 'values'=>$categories , 'selected' => Session::get('category')))
            @else
                @include('form.select', array('fieldname'=>'category', 'label'=>'Category', 'values'=>$categories ))
            @endif
            @if ($errors->has('category'))
                {{ $errors->first('category', '<p class="error-msg">:message</p>')}}
            @endif


            @if(Session::has('lat') && Session::has('lng'))
                 @include('widgets.mapForm', array( 'location'=> Session::get('location'), 'label'=>'Class Location','fieldname1'=>'street', 'placeholder1'=>'Street name and number', 'maxlength1'=>50, 'fieldname2'=>'city', 'placeholder2'=>'City', 'maxlength2'=>50, 'fieldname3'=>'postcode', 'placeholder3'=>'Post Code', 'maxlength3'=>10, 'fieldtext'=>'Enter the location of your class and make sure the marker appears in the correct place on the map above. (You can drag the marker to the correct place if it doesn&apos;t match up) '  , 'lat' => Session::get('lat'), 'lng' => Session::get('lng')))
            @else
                @include('widgets.mapForm', array( 'label'=>'Class Location','fieldname1'=>'street', 'placeholder1'=>'Street name and number', 'maxlength1'=>50, 'fieldname2'=>'city', 'placeholder2'=>'City', 'maxlength2'=>50, 'fieldname3'=>'postcode', 'placeholder3'=>'Post Code', 'maxlength3'=>10, 'fieldtext'=>'Enter the location of your class and make sure the marker appears in the correct place on the map above. (You can drag the marker to the correct place if it doesn&apos;t match up)'))
            @endif

            @if(Session::has('duration'))
                @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'Between 20 and 240 mins', 'maxlength'=>3, 'label'=>'Class Duration', 'fieldtext'=>'Use the slider to input the duration of your class', 'default'=>Session::get('duration') ))
            @else
                @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'Between 20 and 240 mins', 'maxlength'=>3, 'label'=>'Class Duration', 'fieldtext'=>'Use the slider to input the duration of your class', 'default'=>50 ))
            @endif

            @if ($errors->has('duration'))
                {{ $errors->first('duration', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('maxsize'))
                @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'Between 1 and 100', 'maxlength'=>3, 'label'=>'Maximum Class Size', 'fieldtext'=>'Use the slider to select the maximum number of participants you are willing to have in your class.' , 'default' => Session::get('maxsize') ))
            @else
                @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'Between 1 and 100', 'maxlength'=>3, 'label'=>'Maximum Class Size', 'fieldtext'=>'Use the slider to select the maximum number of participants you are willing to have in your class.', 'default'=>10 ))
            @endif

            @if ($errors->has('maxsize'))
                {{ $errors->first('maxsize', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('price'))
                @include('form.slider', array('fieldname'=>'price', 'placeholder'=>'Between 1 and 120 pounds', 'maxlength'=>6, 'label'=>'Class Price', 'fieldtext'=>'Use the slider to input the price you want to charge each participant for your class.' , 'default' => Session::get('price') ))
            @else
                @include('form.slider', array('fieldname'=>'price', 'placeholder'=>'Between 1 and 120 pounds', 'maxlength'=>6, 'label'=>'Class Price', 'fieldtext'=>'Use the slider to input the price you want to charge each participant for your class.', 'default'=>15 ))
            @endif

            @if ($errors->has('price'))
                {{ $errors->first('price', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('image'))
                {{ Form::hidden( 'thumbFilename' , Session::get('image') , array('id' => 'thumbFilename')) }}
            @else
                {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
            @endif
            
            <div class="center-btn-wrapper" >
        	   {{ Form::submit('Create Class' , array('class'=>'btn-yellow ')) }}
            </div>

    	        <div class="success_msg">Success!</div>

        {{ Form::close() }}
    </div>
        


@stop