@extends('layouts.master')


@section('content')


	@include('layouts.pagetitle', array('title'=>trans('evercisegroups-create.title'), 'subtitle'=>trans('evercisegroups-create.subtitle')))
<div class="full-width">
    <div class="col10 push1">
        <div id="upload_wrapper">
            @if(Session::has('image_full'))
                @include('widgets.upload-form', array('uploadImage' => Session::get('image_full').'?'.time() , 'label' => trans('evercisegroups-create.upload_image'), 'fieldtext'=>trans('evercisegroups-create.choose_class_image')))
            @else
                @include('widgets.upload-form', array('uploadImage' => null, 'default_image' => HTML::image( '/img/add_eg.png', 'preview image', array('class' => 'class-block-img')) , 'label' => trans('evercisegroups-create.upload_image'), 'fieldtext'=>trans('image.choose_class_image_tooltip')))
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
                @include('form.textarea', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 5000 characters', 'maxlength'=>5000, 'label'=>'Class description', 'tooltip'=>'Tell people what’s special about this class.  Use your words wisely to describe as concisely and clearly as possible what a participant can hope to gain from joining your class. <br>Contact details can not be provided (telephone numbers, URLs or email addresses) in this panel. Any information not related to your fitness class will be deleted.', 'default' => Session::get('description') ))
            @else
                @include('form.textarea', array('fieldname'=>'description', 'placeholder'=>'Between 100 and 5000 characters', 'maxlength'=>5000, 'label'=>'Class description', 'tooltip'=>'Tell people what’s special about this class.  Use your words wisely to describe as concisely and clearly as possible what a participant can hope to gain from joining your class. <br>Contact details can not be provided (telephone numbers, URLs or email addresses) in this panel. Any information not related to your fitness class will be deleted.' ))
            @endif

            @if ($errors->has('summary'))
                {{ $errors->first('summary', '<p class="error-msg">:message</p>')}}
            @endif


            @include('widgets.autocomplete-category', ['fieldname'=>'category1', 'label'=>'category 1', 'force'=>1 , 'placeholder' => trans('evercisegroups-create.categories') , 'tooltip' => trans('evercisegroups-create.first_cat_tooltip')])
            @include('widgets.autocomplete-category', ['fieldname'=>'category2', 'label'=>'category 2', 'force'=>1, 'placeholder' => trans('evercisegroups-create.categories')])
            @include('widgets.autocomplete-category', ['fieldname'=>'category3', 'label'=>'category 3', 'force'=>1 , 'placeholder' => trans('evercisegroups-create.categories')])

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