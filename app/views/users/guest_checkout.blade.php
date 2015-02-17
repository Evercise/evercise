
    @if($referralCode)
         <div class="referral-wrapper">
            <p>Sign up now to receive your {{ Evercoin::poundsToEvercoins(Config::get('values')['freeCoins']['referral_signup']) }} Evercoins!</p>
        </div>
     @endif
    @if($ppcCode)
         <div class="referral-wrapper">
            <p>Sign up now to receive your  {{ Evercoin::poundsToEvercoins(Config::get('values')['freeCoins']['ppc_signup']) }} Evercoins!</p>
        </div>
     @endif



    <div class="center-btn-wrapper">
         @if(isset($type))
            {{ HTML::linkRoute('users.fb', 'Sign up with facebook', $type, ['class' => 'btn btn-fb btn-large']) }}
        @else
            {{ HTML::linkRoute('users.fb', 'Sign up with facebook', null, ['class' => 'btn btn-fb btn-large']) }}
        @endif

         <br>
        <br>
    </div>
    <div class="center-btn-wrapper">
        <div class="orSeperator">
            <span>or</span>
        </div>
        <br>
        <br>
    </div>




    @if(isset($typeId))
        {{ Form::open(array('id' => 'user_create_'.$typeId.'', 'url' => 'users', 'method' => 'post', 'class' => 'create-form')) }}
    @else
        {{ Form::open(array('id' => 'user_create', 'url' => 'users', 'method' => 'post', 'class' => 'create-form')) }}
    @endif



        <div class="col9 push2">

        	@include('form.textfield', array('fieldname'=>'display_name', 'placeholder'=>'Between 5 and 20 characters', 'maxlength'=>20, 'label'=>'Display Name', 'tooltip'=> trans('tooltips.user_display_name') , 'insert' => 'evercise.com/users/' ))
            @if ($errors->has('display_name'))
                {{ $errors->first('display_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 2 and 15 characters', 'maxlength'=>15, 'label'=>'First name', 'tooltip'=> trans('tooltips.user_first_name') ))
            @if ($errors->has('first_name'))
                {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 2 and 15 characters', 'maxlength'=>15, 'label'=>'Last name', 'tooltip'=> trans('tooltips.user_last_name') ))
            @if ($errors->has('last_name'))
                {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.datepicker', array('fieldname'=>'dob', 'id' => isset($typeId)? $typeId : null ,'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth' ))
            @if ($errors->has('dob'))
                {{ $errors->first('dob', '<p class="error-msg">:message</p>')}}
            @endif

        	@include('form.textfield', array('fieldname'=>'email', 'default'=>isset($email) ? $email : '', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Email address', 'tooltip'=> trans('tooltips.user_email')))
            @if ($errors->has('email'))
                {{ $errors->first('email', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.password', array('fieldname'=>'password', 'placeholder'=>'Password', 'maxlength'=>32, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'tooltip'=> trans('tooltips.user_password')))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
            @include('form.phone', array('fieldname'=>'phone', 'placeholder'=>'Phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'tooltip'=> trans('tooltips.user_phone')))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.select', array('fieldname'=>'gender', 'label'=>'Gender', 'values'=>array(1=>'Male', 2=>'Female')))
        	@include('form.checkbox', array('id' => isset($checkboxId) ? $checkboxId : 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))
        </div>


        @if(isset($type))
            {{ Form::hidden( 'redirect' , $type , array('id' => 'redirect')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit(isset($typeId) ? 'Register as '.$typeId : 'Register' , array('class'=>'btn btn-yellow btn-large')) }}
        </div>
        <div class="success_msg">Success, We are now directing you to you user dashboard.</div>

    {{ Form::close() }}


