@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>trans('trainers-create.title'), 'subtitle'=>trans('trainers-create.subtitle')))
    <div class="col10 push1">
        <div id="upload_wrapper">
            @include('widgets.upload-form', array('uploadImage' => $userImage, 'default_image' => HTML::image( '/img/add_users.png', 'preview image', array('class' => 'class-block-img')) , 'label' => trans('trainers-create.upload_image'), 'fieldtext'=>trans('image.choose_class_image_tooltip')))
        </div>
    
        {{ Form::open(array('id' => 'trainer_create', 'route' => 'trainers.store', 'method' => 'post', 'class' => 'create-form')) }}

        @include('form.blank', array('blank'=>'image'))
        @if ($errors->has('image'))
            {{ $errors->first('image', '<p class="error-msg">:message</p>')}}
        @endif
        @include('form.textfield', array('fieldname'=>'profession', 'placeholder'=>'max 50 characters', 'maxlength'=>50, 'label'=>'Add your profession', 'tooltip'=> trans('tooltips.trainer_profession') ))
        @if ($errors->has('profession'))
            {{ $errors->first('profession', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textarea', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'tooltip'=> trans('tooltips.trainer_bio') ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif
         @include('form.phone', array('default_area' => $user->area_code , 'default' => $user->phone , 'fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'tooltip'=> trans('tooltips.trainer_phone')))
        @if ($errors->has('phone'))
            {{ $errors->first('phone', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>100, 'label'=>'Add your website', 'tooltip'=> trans('tooltips.trainer_website') ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        @if(basename($user->image) != 'no-user-img.jpg')
            {{ Form::hidden( 'image' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'image' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Finish trainer registration' , array('class'=>'btn btn-yellow btn-large')) }}
        </div>
        {{ Form::close() }}
     </div>


@stop