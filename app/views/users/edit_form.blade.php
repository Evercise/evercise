
	{{ Form::open(array('id' => 'user_edit', 'url' => 'users/'.$userId, 'method' => 'PUT', 'class' => 'create-form')) }}

        @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Add your first name', 'fieldtext'=>'Please add your first name.', 'default'=>$firstName ))
        @if ($errors->has('first_name'))
            {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'Add your last name', 'fieldtext'=>'Please add your last name.', 'default'=>$lastName ))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.datepicker', array('fieldname'=>'dob', 'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth', 'fieldtext'=>'Please Add your date of birth.', 'default'=>$dob))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Your email address', 'fieldtext'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.', 'default'=>$email))
        @if ($errors->has('email'))
            {{ $errors->first('email', '<p class="error-msg">:message</p>')}}
        @endif
    	@include('form.password', array('fieldname'=>'password', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'fieldtext'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
        @endif
    	@include('form.select', array('fieldname'=>'gender', 'label'=>'Please select your sex', 'values'=>array(1=>'Male', 2=>'Female'), 'selected'=>$gender))
    	@include('form.checkbox', array('id' => 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Save changes' , array('class'=>'btn-yellow ')) }}
        </div>
        <div class="success_msg">Details updated</div>
	{{ Form::close() }}
