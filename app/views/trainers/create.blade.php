@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'Become a Trainer', 'subtitle'=>'Fill in your details below.'))
    <div class="col10 push1">
        <div id="upload_wrapper">
            @include('widgets.upload-form', array('uploadImage' => $userImage, 'default_image' => HTML::image( '/img/add_users.png', 'preview image', array('class' => 'class-block-img')) , 'label' => 'Upload you user image', 'fieldtext'=>'This image will appear on your profile and will be visible to Evercise members.'))
        </div>
    
        {{ Form::open(array('id' => 'trainer_create', 'url' => 'trainers', 'method' => 'post', 'class' => 'create-form')) }}


        @include('form.textfield', array('fieldname'=>'profession', 'placeholder'=>'Add your profession', 'maxlength'=>500, 'label'=>'Add your profession', 'fieldtext'=>'Please add your profession' ))
        @if ($errors->has('profession'))
            {{ $errors->first('profession', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'fieldtext'=>'Your biography will be visible on your profile and will give members a more personal insight into you as an instructor. (example: Kayla is a qualified pool yoga instructor with 5 years of experience helping swimmers improve strength and flexibility in the pool. She is excited to meet new swimmers and help them improve their practice while decreasing chances of injury. She loves canoeing and camping, and is very happy to be a part of the evercise team!)' ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif
         @include('form.phone', array('default_area' => $user->area_code , 'default' => $user->phone , 'fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'fieldtext'=>'Please add your phone number including area code'))
        @if ($errors->has('phone'))
            {{ $errors->first('phone', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>100, 'label'=>'Add your website', 'fieldtext'=>'(Optional) - If you want users to learn more about you and what you do, you can include your web address, which will be visible on your profile.' ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        @if(basename($user->image) != 'no-user-img.jpg')
            {{ Form::hidden( 'image' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'image' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>
        {{ Form::close() }}
     </div>


@stop