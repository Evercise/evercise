<div id="login_wrap" class="login_wrap">
    <div id="cancel_login" class="cancel">x</div>
    {{ Form::open(array('id' => 'login_form', 'url' => 'auth/login', 'method' => 'post')) }}
        @if ($errors->has('login'))
                <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
        @endif
        <div>
            @include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'email', 'maxlength'=>50, 'label'=>'Please enter your email', 'fieldtext'=>null ))
        </div>
        <div>
            @include('form.password', array('fieldname'=>'password', 'placeholder'=>'password', 'maxlength'=>20, 'label'=>'Please enter your password', 'fieldtext'=>null ))
            @include('form.hidden', array('fieldname'=>'redirect_after_login',  'value' =>$redirect_after_login ))
            @include('form.hidden', array('fieldname'=>'redirect_after_login_url',  'value' =>$redirect_after_login_url))
             
        </div>
        <br>
        <div>
            {{ Form::submit('Login', array('class' => 'btn btn-yellow')) }}
        </div>
        <div class="orSeperator"><span>or</span></div>
    {{ Form::close() }}
    @if ($redirect_after_login == 1)
       {{ HTML::link('login/fb/'.$redirect_after_login_url, 'Log in with facebook', array('class' => 'btn btn-fb')) }}
    @else
        {{ HTML::link('login/fb', 'Log in with facebook', array('class' => 'btn btn-fb')) }}
    @endif
    <div class="mt10">
     {{ HTML::link('auth/forgot', 'Forgot password?') }}
    </div>
</div>
