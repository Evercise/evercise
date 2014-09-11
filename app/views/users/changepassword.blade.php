<div class="mt30">
    {{ Form::open(array('id' => 'password_change', 'url' => 'users/changepassword', 'method' => 'post', 'class' => 'create-form')) }}

        @if ($errors->has('forgot'))
            <div class="input-wrapper">
                <div class="error-msg">{{ $errors->first('forgot', ':message') }}</div>
            </div>
        @endif
        @if (isset($message))
            <div class="input-wrapper">
                <div class="error-msg">{{ $message }}</div>
            </div>
        @else
            <div class="input-wrapper">

                @include('form.password', array('fieldname'=>'old_password', 'placeholder'=>'Enter your current password', 'maxlength'=>20, 'label'=>'Your current password', 'fieldtext'=>''))
                @if ($errors->has('old_password'))
                    {{ $errors->first('old_password', '<p class="error_msg">:message</p>')}}
                @endif

                @include('form.password', array('fieldname'=>'password', 'placeholder'=>'Choose a password', 'maxlength'=>20, 'confirmation'=> 'Please re-enter your password', 'label'=>'Your new password', 'tooltip'=>'For increased security, please choose a password with a combination of lowercase and numbers'))
                @if ($errors->has('password'))
                    {{ $errors->first('password', '<p class="error_msg">:message</p>')}}
                @endif

            </div>
            <div class="center-btn-wrapper" >
                {{ Form::submit('Reset Password', array('class' => 'btn btn-yellow')) }}
            </div>
        @endif
        <div class="success_msg">Details updated</div>
    {{ Form::close() }} 
</div>
