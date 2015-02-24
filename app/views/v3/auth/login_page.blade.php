@extends('v3.layouts.master')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 mt50">
                {{ Form::open(['id' => 'login-form', 'route' => 'auth.login.post', 'method' => 'post', 'class'=>'mb10 login-form', 'role' => 'form'] ) }}
                    {{ Form::hidden('redirect_after_login', true) }}
                    {{ Form::hidden('redirect_after_login_url', $redirect_after_login_url) }}

                    {{ Html::linkRoute('users.fb', 'Connect via Facebook', [$redirect_after_login_route], ['class' => 'custom-fb mb15']) }}
                    <div class="text-divider mb15 pull-left">or</div>
                    <label for="account">Do you have an Evercise account?</label>
                    <div class="input-list">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <label for="email">Email:</label>
                            </div>
                            {{ Form::email('email',null, ['class'=>'form-control input-lg', 'placeholder' => 'name@address.com']) }}
                        </div>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label for="ps" >Password: </label>
                            </div>
                            {{ Form::password('password',['class' => 'form-control input-lg']) }}
                        </div>
                    </div>
                    <div class="pull-right mt15">
                        {{ HTML::linkRoute('auth.forgot', 'Forgot your Password?' , null, ['class' => 'text-right link']) }}
                    </div>


                    {{ Form::submit('Login', ['class' => 'btn btn-white-primary btn-block', 'id' => 'cart-account']) }}
                {{Form::close()}}
            </div>
        </div>
    </div>



@stop