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
            @include('form.hidden', array('fieldname'=>'redirect_after_login_url',  'value' => ($redirect_after_login_url == 'trainers/create' ? null : $redirect_after_login_url)))
             
        </div>
        <br>
        <div>
            {{ Form::submit('Login', array('class' => 'btn btn-yellow')) }}
        </div>
        <div class="orSeperator"><span>or</span></div>
    {{ Form::close() }}
    @if ($redirect_after_login == 1)
       {{ HTML::linkRoute('users.fb', 'Log in with facebook', ($redirect_after_login_url == 'trainers/create' ? null : $redirect_after_login_url),  ['class' => 'btn btn-fb']) }}
    @else
        {{ HTML::linkRoute('users.fb', 'Log in with facebook', null , ['class' => 'btn btn-fb']) }}
    @endif
    <div class="mt10">
    <div class="orSeperator"><span>Not registered yet?</span></div>

    @if ($redirect_after_login == 1)
         {{  HTML::linkRoute('users.create', trans('header.register') , ($redirect_after_login_url == 'trainers/create' ? null : $redirect_after_login_url) , [ 'class' => 'btn btn-blue mb10' ])}}
    @else
        {{  HTML::linkRoute('users.create', trans('header.register') , null , [ 'class' => 'btn btn-blue mb10' ])}}
    @endif
    {{ HTML::linkRoute('auth.forgot', 'Forgot password?' , null) }}
    </div>
</div>
