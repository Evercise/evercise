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
        @include('form.textfield', array('fieldname'=>'profession', 'placeholder'=>'max 50 characters', 'maxlength'=>50, 'label'=>'Add your profession', 'tooltip'=>'Please add your profession (example: “Personal trainer”, “Yoga instructor”, “Tennis coach”, “fitness specialist”, ...)' ))
        @if ($errors->has('profession'))
            {{ $errors->first('profession', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textarea', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'tooltip'=>'Your biography will be visible on your profile and will give members a more personal insight into you as an instructor. (example: Kayla is a qualified aqua spin instructor with 5 years of experience helping swimmers improve strength and flexibility in the pool. She is excited to meet new swimmers and spinners to help them improving their practice while decreasing chances of injury. She loves canoeing and camping, and is very happy to be a part of the evercise community!)' ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif
         @include('form.phone', array('default_area' => $user->area_code , 'default' => $user->phone , 'fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'tooltip'=>'Please provide your phone number in case we need to contact you about your account.'))
        @if ($errors->has('phone'))
            {{ $errors->first('phone', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>100, 'label'=>'Add your website', 'tooltip'=>'(Optional) - If you want users to learn more about you and what you do, you can include your web address, which will be visible on your profile.' ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        @if(basename($user->image) != 'no-user-img.jpg')
            {{ Form::hidden( 'thumbFilename' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Finish trainer registration' , array('class'=>'btn btn-yellow btn-large')) }}
        </div>
        {{ Form::close() }}
     </div>


@stop