<div id="upload_wrapper">
    @include('widgets.upload-form', array('uploadImage' => $userImage, 'default_image' => HTML::image( '/img/add_users.png', 'preview image', array('class' => 'class-block-img')) , 'label' => 'Upload you user image', 'fieldtext'=>'This image will appear on your profile and will be visible to Evercise members.'))
</div>
	{{ Form::open(array('id' => 'user_edit', 'url' => 'users/'.$user->id, 'method' => 'PUT', 'class' => 'create-form')) }}

        @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'first name', 'fieldtext'=>'This is your first name.', 'default'=>$firstName ))
        @if ($errors->has('first_name'))
            {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'last name', 'fieldtext'=>'your last name.', 'default'=>$lastName ))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.datepicker', array('fieldname'=>'dob', 'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth', 'fieldtext'=>'date of birth.', 'default'=>date('Y-m-d',strtotime($dob))))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.', 'default'=>$email))
        @if ($errors->has('email'))
            {{ $errors->first('email', '<p class="error-msg">:message</p>')}}
        @endif
        
        @include('form.phone', array('fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'fieldtext'=>'(Optional) - Your phone number will never be shared and will only be used to contact you if there is any last minute changes with your classes', 'default_area'=>$area_code, 'default'=>$phone))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.select', array('fieldname'=>'gender', 'label'=>'gender', 'values'=>array(1=>'Male', 2=>'Female'), 'selected'=>$gender))
        {{-- 
        marketing preferences to be used in edit preferences

    	@include('form.checkbox', array('id' => 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.', 'default'=> ($marketingPreference=='yes') ))
        --}}

        @if(basename($user->image) != '')
            {{ Form::hidden( 'thumbFilename' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Save changes' , array('class'=>'btn btn-yellow ')) }}
        </div>
        <div class="success_msg">Details updated</div>
	{{ Form::close() }}
