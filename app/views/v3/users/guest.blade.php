@extends('v3.layouts.master')
@section('body')


        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    {{ Form::open(['id' => 'login-form', 'route' => 'auth.login.post', 'method' => 'post', 'class'=>'mb10', 'role' => 'form'] ) }}
                    {{ Form::hidden('redirect', 'cart.checkout') }}
                        <div class="col-sm-12">
                            <li role="presentation" class="dropdown-header">Login</li>
                            <div class="form-group">
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            <div class="form-group">
                                {{  Form::submit('Login', ['class' => 'btn btn-primary btn-block'] ) }}
                                <div class="col-sm-6 text-center mb15 mt5">
                                    {{ HTML::linkRoute('auth.forgot', 'Forgot password?' ) }}
                                </div>
                            </div>
                        </div>


                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="underline">
                <h1>Your Details</h1>
            </div>
        </div>




        <div class="row text-center">
            <div class="underline">
                <h1>Your Details</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    {{ Form::open(['route' => 'users.guest.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'register-form'] ) }}

                        <div class="row  mt10">
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('first_name', 'Forename', ['class' => 'mb15'] )  }}
                                 {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your first name']) }}
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('last_name', 'Surname' , ['class' => 'mb15'])  }}
                                 {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your second name']) }}
                               </div>
                            </div>
                        </div>


                        <div class="row  mt10">
                            <div class="col-sm-6">
                                 <div class="form-group mb50">
                                     {{ Form::label('email', 'Email Address', ['class' => 'mb15'] )  }}
                                     {{ Form::email('email', isset($email) ? $email : '', ['class' => 'form-control', 'placeholder' => 'Enter your current email address']) }}
                                   </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="mb15" for="phone">Phone Number<small> (Get alerts about classes)</small></label>

                                <div class="input-group">
                                    <div class="input-group-addon custom-select">
                                       {{ Form::select('areacode', Config::get('countrycodes.pretty')
                                        , '+44', ['class' => 'select-addon'] ) }}
                                    </div>
                                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>


                        <div class="text-center form-group mt40">
                            {{ Form::submit('Checkout', ['class' => 'btn btn-primary'] )  }}
                        </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
@stop