@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        @if($referralCode)
             <div class="referral-wrapper">
                <p>Your referral code is valid! Sign up now to receive £{{ Config::get('values')['freeCoins']['referral_signup'] }} credited to your account!</p>
            </div>
         @endif
        <div class="row text-center">
            <div class="underline">
                <h1>Register</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    {{ Form::open(['route' => 'users.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'register-form'] ) }}
                        <div>
                           {{ Form::label('trainer-question', 'Are you a trainer?', ['class' => 'col-sm-3 col-sm-offset-3 control-label text-right'])  }}
                           <div class="col-sm-6 mb20">
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'yes') }}
                                 Yes
                               </label>
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'no', true) }}
                                 No
                               </label>
                           </div>
                        </div>
                        <div class="mb20 text-center">
                            {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-fb"></span>Log in with facebook', null , ['class' => 'btn btn-lg btn-fb', 'id' => 'register-fb']) )}}
                        </div>
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
                                 {{ Form::label('display_name', 'Your Evercise Display Name', ['class' => 'mb15'] )  }}
                                 {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'This will be your name on Evercise']) }}
                                  <!--<em class="help-block">evercise.com/users/</em>-->
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('email', 'Email Address', ['class' => 'mb15'] )  }}
                                 {{ Form::email('email', isset($email) ? $email : '', ['class' => 'form-control', 'placeholder' => 'Enter your current email address']) }}
                               </div>
                            </div>
                        </div>
                        <div class="row  mt10">
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('password', 'Password' , ['class' => 'mb15'])  }}
                                 {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter a password']) }}
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('confirmed_password', 'Confirmed Password' , ['class' => 'mb15'])  }}
                                 {{ Form::password('confirmed_password', ['class' => 'form-control', 'placeholder' => 'confirm your password']) }}
                               </div>
                            </div>
                        </div>
                        <div class="row  mt10">
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
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                   <label class="mb15" for="forename">Gender</label>
                                   <div class="custom-select">
                                       {{ Form::select('gender',
                                           [
                                               'male' => 'male',
                                               'female' => 'female'
                                           ]
                                        , 'female', ['class' => 'form-control'] ) }}
                                   </div>
                               </div>
                            </div>
                        </div>


                        <div class="text-center">
                            <label class="custom-checkbox">
                                {{ Form::checkbox('newsletter', 'yes', true ) }}

                                 Get all the latest deals and news info by signing up to our newsletter
                            </label>

                        </div>
                        <div class="text-center form-group mt40">
                            {{ Form::submit('Create My Account', ['class' => 'btn btn-primary'] )  }}
                        </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
@stop