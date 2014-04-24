<div id="login_wrap" class="login_wrap">
    <div id="cancel_login" class="cancel">X</div>
    {{ Form::open() }}
        @if ($errors->has('login'))
                <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
        @endif
        <div>
            @include('form.textfield', array('fieldname'=>'email', 'placeholder'=>'email', 'maxlength'=>50, 'label'=>'Please enter your email', 'fieldtext'=>null ))
        </div>
        <div>
            @include('form.textfield', array('fieldname'=>'password', 'placeholder'=>'password', 'maxlength'=>20, 'label'=>'Please enter your password', 'fieldtext'=>null ))
        </div>
        <br>
        <div>
            {{ Form::submit('Login', array('class' => 'btn-yellow')) }}
        </div>
        <div class="orSeperator"><span>or</span></div>
    {{ Form::close() }}
        <a class="btn-fb" href="../login/fb" >Log in with facebook</a>
</div>
