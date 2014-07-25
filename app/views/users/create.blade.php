
    @if($referralCode)
         <div class="referral-wrapper">
            <p>Your referral code is valid! If you sign up now you will receive 1 Evercoin!</p>
        </div>
     @endif

       
   
    <div class="center-btn-wrapper">
         @if(isset($typeId))
            {{ HTML::link('login/fb/'.$typeId.'', 'Sign up with facebook', array('class' => 'btn btn-fb btn-large')) }}
        @else
            {{ HTML::link('login/fb', 'Sign up with facebook', array('class' => 'btn btn-fb btn-large')) }}
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

        	@include('form.textfield', array('fieldname'=>'display_name', 'placeholder'=>'Between 5 and 20 characters', 'maxlength'=>20, 'label'=>'Display_name', 'tooltip'=>'This will be your display name visible to all Evercise members. It will also be used when you create a class.' ))
            @if ($errors->has('display_name'))
                {{ $errors->first('display_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>15, 'label'=>'First name', 'tooltip'=>'Please add your first name.' ))
            @if ($errors->has('first_name'))
                {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>15, 'label'=>'Last name', 'tooltip'=>'Please add your last name.' ))
            @if ($errors->has('last_name'))
                {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
            @endif

            @include('form.datepicker', array('fieldname'=>'dob', 'id' => isset($typeId)? $typeId : null ,'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth' ))
            @if ($errors->has('last_name'))
                {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
            @endif

        	@include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'Type your current email address here', 'maxlength'=>50, 'label'=>'Email address', 'tooltip'=>'We will use your e-mail address to confirm your identity and send you information relating to your classes.<br/>Your e-mail address is safe with us: we will not distribute it to any third parties.'))
            @if ($errors->has('email'))
                {{ $errors->first('email', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.password', array('fieldname'=>'password', 'placeholder'=>'Password', 'maxlength'=>32, 'confirmation'=> 'Please re-enter your password', 'label'=>'Create your password', 'tooltip'=>'For increased security, please choose a password with a combination of lowercase, capital letters and numbers (but no symbols).'))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
            @include('form.phone', array('fieldname'=>'phone', 'placeholder'=>'Phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'tooltip'=>'(Optional) - Your phone number will only be used in case of emergency (cancellations, etc.)'))
            @if ($errors->has('password'))
                {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
            @endif
        	@include('form.select', array('fieldname'=>'gender', 'label'=>'Gender', 'values'=>array(1=>'Male', 2=>'Female')))
        	@include('form.checkbox', array('id' => 'userNewsletter', 'fieldname'=>'userNewsletter', 'label'=>'Check this box if you wish receive our newsletter and discover exciting new classes.'))
        </div>


        @if(isset($type))
            {{ Form::hidden( 'redirect' , $type , array('id' => 'redirect')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit(isset($typeId) ? 'Register as '.$typeId : 'Register' , array('class'=>'btn btn-yellow btn-large')) }}
        </div>
        <div class="success_msg">Success, We are now directing you to you user dashboard.</div>

    {{ Form::close() }}
    

