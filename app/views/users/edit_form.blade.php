<div id="upload_wrapper">
    @include('widgets.upload-form', array('uploadImage' => 'profiles/'. $user->directory.'/'.$user->image, 'label' => 'Upload you user image', 'fieldtext'=>'This image will appear on your profile and will be visible to Evercise members.'))
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

        @include('form.password', array('fieldname'=>'new_password', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'New password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.select', array('fieldname'=>'gender', 'label'=>'gender', 'values'=>array(1=>'Male', 2=>'Female'), 'selected'=>$gender))
        {{-- 
        marketing preferences to be used in edit preferences

    	@include('form.checkbox', array('id' => 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.', 'default'=> ($marketingPreference=='yes') ))
        --}}
        @include('form.password', array('fieldname'=>'old_password', 'placeholder'=>'Current password', 'maxlength'=>20, 'label'=>'Current password', 'fieldtext'=>'To change your settings, Please enter your current password.' , 'forgot' => 'I forgot my password'))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
        @endif

        @if(basename($user->image) != 'no-user-img.jpg')
            {{ Form::hidden( 'thumbFilename' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Save changes' , array('class'=>'btn-yellow ')) }}
        </div>
        <div class="success_msg">Details updated</div>
	{{ Form::close() }}
