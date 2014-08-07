@extends('layouts.master')


@section('content')


	@include('layouts.pagetitle', array('title'=>'Add the information about your class', 'subtitle'=>'Make it as relevant and interesting as possible'))
<div class="full-width">
    <div class="col10 push1">
        <div id="upload_wrapper">
            @if(Session::has('image_full'))
                @include('widgets.upload-form', array('uploadImage' => Session::get('image_full') , 'label' => 'Upload you class image', 'fieldtext'=>'Choose a suitable image to represent your class'))
            @else
                @include('widgets.upload-form', array('uploadImage' => null, 'default_image' => HTML::image( '/img/add_eg.png', 'preview image', array('class' => 'class-block-img')) , 'label' => 'Upload you class image', 'fieldtext'=>'<span class="tooltip" data-tooltip="You must own the image or have the permission of the image owner to use it. <br>The image you choose for your profile and/or class must not contain any of the following:<li>Trademarks or company names – eg, images marked with ® or ™ signs</li> <li>mages or text protected by copyright – eg, images marked with © or other watermarks or notations</li><li>Contact information – telephone numbers, URLs or email addresses</li><li>Political statements or images relating to ethnicity or religion</li><li>Provocative, lewd or sexual images or content</li><li>Offensive material – images, signs, symbols or text relating to violence, death, injury, racism, cruelty, profanity, obscenity, weapons, firearms, ammunition or terrorism</li><li>Content where drinking, being drunk, smoking or gambling is the focus</li>">Choose a suitable image to represent your class.<br> Uploaded images must conform to the following guidelines: (* click to see guidelines)</span>'))
            @endif
        </div>

        {{ Form::open(array('id' => 'venue_create', 'url' => 'venues', 'method' => 'post', 'class' => 'create-form')) }}
        {{ Form::close() }}

    	{{ Form::open(array('id' => 'evercisegroup_create', 'url' => 'evercisegroups', 'method' => 'post', 'class' => 'create-form')) }}
             @include('form.blank', array('blank'=>'image'))
            @if ($errors->has('image'))
                {{ $errors->first('image', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('name'))
                @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Between 5 and 100 characters', 'maxlength'=>100, 'label'=>'Class Name',  'tooltip'=>'One simple, specific and memorable sentence. It should clarify the nature of the service you are going to provide. Try not to be too general. <br> Example : « Bootcamps class for ladies in Regent&apos;s Park »', 'default' => Session::get('name') ))
            @else
                @include('form.textfield', array('fieldname'=>'classname', 'placeholder'=>'Between 5 and 30 characters', 'maxlength'=>30, 'label'=>'Class Name',  'tooltip'=>'One simple, specific and memorable sentence. It should clarify the nature of the service you are going to provide. Try not to be too general. <br> Example : « Bootcamps class for ladies in Regent&apos;s Park »', ))
            @endif

            @if ($errors->has('classname'))
                {{ $errors->first('classname', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('description'))
                @include('form.textarea', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 500 characters', 'maxlength'=>500, 'label'=>'Class description', 'tooltip'=>'Tell people what’s special about this class.  Use your words wisely to describe as concisely and clearly as possible what a participant can hope to gain from joining your class. <br>Contact details can not be provided (telephone numbers, URLs or email addresses) in this panel. Any information not related to your fitness class will be deleted.', 'default' => Session::get('description') ))
            @else
                @include('form.textarea', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 500 characters', 'maxlength'=>500, 'label'=>'Class description', 'tooltip'=>'Tell people what’s special about this class.  Use your words wisely to describe as concisely and clearly as possible what a participant can hope to gain from joining your class. <br>Contact details can not be provided (telephone numbers, URLs or email addresses) in this panel. Any information not related to your fitness class will be deleted.' ))
            @endif

            @if ($errors->has('summary'))
                {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
            @endif


            @include('widgets.autocomplete-category', ['fieldname'=>'category1', 'label'=>'category 1', 'force'=>1])
            @include('widgets.autocomplete-category', ['fieldname'=>'category2', 'label'=>'category 2', 'force'=>1])
            @include('widgets.autocomplete-category', ['fieldname'=>'category3', 'label'=>'category 3', 'force'=>1])

            @if ($errors->has('category'))
                {{ $errors->first('category', '<p class="error-msg">:message</p>')}}
            @endif

            @include('venues.select')


            @if(Session::has('duration'))
                @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'Between 20 and 240 mins', 'maxlength'=>3, 'label'=>'Class Duration (mins)', 'tooltip'=>'Use the slider to input the duration of your class. Minimum: 10 minutes.', 'default'=>Session::get('duration') ))
            @else
                @include('form.slider', array('fieldname'=>'duration', 'placeholder'=>'Between 20 and 240 mins', 'maxlength'=>3, 'label'=>'Class Duration (mins)', 'tooltip'=>'Use the slider to input the duration of your class. Minimum: 10 minutes.', 'default'=>50 ))
            @endif

            @if ($errors->has('duration'))
                {{ $errors->first('duration', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('maxsize'))
                @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'Between 1 and 100', 'maxlength'=>3, 'label'=>'Available tickets', 'tooltip'=>'Use the slider to select the maximum number of participants you are willing to have in your class. Minimum: 1 participant' , 'default' => Session::get('maxsize') ))
            @else
                @include('form.slider', array('fieldname'=>'maxsize', 'placeholder'=>'Between 1 and 100', 'maxlength'=>3, 'label'=>'Available tickets', 'tooltip'=>'Use the slider to select the maximum number of participants you are willing to have in your class. Minimum: 1 participant', 'default'=>10 ))
            @endif

            @if ($errors->has('maxsize'))
                {{ $errors->first('maxsize', '<p class="error-msg">:message</p>')}}
            @endif

            @if(Session::has('price'))
                @include('form.slider', array('fieldname'=>'price', 'placeholder'=>'Between 1 and 120 pounds', 'maxlength'=>6, 'label'=>'Class Price', 'tooltip'=>'Use the slider to input the price you want to charge each participant for your class. There is no minimum.' , 'default' => Session::get('price') ))
            @else
                @include('form.slider', array('fieldname'=>'price', 'placeholder'=>'Between 1 and 120 pounds', 'maxlength'=>6, 'label'=>'Class Price', 'tooltip'=>'Use the slider to input the price you want to charge each participant for your class. There is no minimum.', 'default'=>5 ))
            @endif

            @if ($errors->has('price'))
                {{ $errors->first('price', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.select', array('fieldname'=>'gender', 'label'=>'Target Gender', 'values'=>array(0=>'All',1=>'Male', 2=>'Female')))

            @if(Session::has('image'))
                {{ Form::hidden( 'image' , Session::get('image') , array('id' => 'thumbFilename')) }}
            @else
                {{ Form::hidden( 'image' , null, array('id' => 'thumbFilename')) }}
            @endif
            
            <div class="center-btn-wrapper" >
                {{ Form::submit('Create Class' , array('class'=>'btn btn-yellow', 'id' => 'create_class')) }}                 
            </div>

        	<div class="success_msg">Success!</div>

            {{ Form::close() }}
    </div>
</div>
        


@stop