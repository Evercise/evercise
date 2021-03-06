@extends('v3.layouts.master')
<?php
    View::share('title', 'Fitness Trainers / Students - Register Here');
    View::share('metaDescription', 'Register with Evercise, active fitness community in London.')
?>
@section('body')
    <div class="container first-container">
        @if($referralCode)
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="alert alert-success text-center">
                       <p>Your referral code is valid! Sign up now to receive £{{ Config::get('values')['freeCoins']['referral_signup'] }} credited to your account!</p>
                    </div>
                </div>
            </div>
         @endif
        @if($ppcCode)
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="alert alert-success text-center">
                       <p>Your code is valid! Sign up now to receive £{{ Config::get('values')['freeCoins']['ppc_signup'] }}, and double it by referring a friend!</p>
                    </div>
                </div>
            </div>
         @endif
        <div class="row text-center">
            <div class="underline">
                <h1>Register</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="">
                    {{ Form::open(['route' => 'users.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'register-form'] ) }}
                        <div class="row sm-text-center">
                           {{ Form::label('trainer-question', 'Are you a trainer?', ['class' => 'col-sm-3 col-sm-offset-3 control-label text-right'])  }}
                           <div class="col-sm-6 mb20">
                               <div class="custom-checkbox pull-left sm-no-float">
                                   {{ Form::radio('trainer', 'yes', false, ['id' => 'yes']) }}
                                   <label for="yes" class="text-grey">Yes</label>
                               </div>
                               <div class="custom-checkbox">
                                  {{ Form::radio('trainer', 'no', true, ['id' => 'no']) }}
                                  <label for="no" class="text-grey">No</label>
                               </div>
                               <!--
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'yes') }}
                                 Yes
                               </label>
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'no', true) }}
                                 No
                               </label>
                               -->
                           </div>
                        </div>
                        <div class="mb20 text-center">
                            {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-fb-white"></span>Log in with facebook', null , ['class' => 'btn btn-lg btn-fb', 'id' => 'register-fb']) )}}
                        </div>
                        <div class="row  mt10">
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('first_name', 'Forename', ['class' => 'mb15 required'] )  }}
                                 {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your first name']) }}
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('last_name', 'Surname' , ['class' => 'mb15 required'])  }}
                                 {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your second name']) }}
                               </div>
                            </div>
                        </div>
                        <div class="row  mt10">
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('display_name', 'Your Evercise Display Name', ['class' => 'mb15 required'] )  }}
                                 {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'This will be your name on Evercise']) }}
                                  <!--<em class="help-block">evercise.com/users/</em>-->
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('email', 'Email Address', ['class' => 'mb15 required'] )  }}
                                 {{ Form::email('email', isset($email) ? $email : '', ['class' => 'form-control', 'placeholder' => 'Enter your current email address']) }}
                               </div>
                            </div>
                        </div>
                        <div class="row  mt10">
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('password', 'Password' , ['class' => 'mb15 required'])  }}
                                 {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter a password']) }}
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group mb50">
                                 {{ Form::label('password_confirmation', 'Confirmed Password' , ['class' => 'mb15 required'])  }}
                                 {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm your password']) }}
                               </div>
                            </div>
                        </div>
                        <div class="row  mt10">
                            <div class="form-group col-sm-8">
                                <label class="mb15" for="phone">Mobile Number <small>(Get alerts about your classes)</small></label>
                                <div class="input-group">
                                     <div class="input-group-addon custom-select">
                                     <select  name="areacode">
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="BR">Brazil</option>
                                        <option value="CN">China</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="IN">India</option>
                                        <option value="MA">Morocco</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="ES">Spain</option>
                                        <option value="TH">Thailand</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="VE">Venezuela</option>
                                    </select>
                                    </div>
                                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <!--
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
                            -->
                            <div class="col-sm-4">
                               <div class="form-group mb50">
                                   <label class="mb15" for="forename">Gender</label>
                                   <div class="custom-select">
                                       {{ Form::select('gender',
                                           [
                                               '' => '',
                                               'male' => 'male',
                                               'female' => 'female'
                                           ]
                                        , '', ['class' => 'form-control'] ) }}
                                   </div>
                               </div>
                            </div>
                        </div>


                        <div class="text-center">
                            <div class="custom-checkbox">
                                {{ Form::checkbox('newsletter', 'yes', true , ['id'=> 'newsletter']) }}
                                <label for="newsletter" class="text-grey"> Get all the latest deals and news info by signing up to our newsletter</label>
                            </div>
                        </div>
                        <div class="text-center mt40">
                            <div class="custom-checkbox">
                                {{ Form::checkbox('terms', 'yes', true , ['id'=> 'terms']) }}
                                <label for="terms" class="text-grey">I Agree With the <a href="{{ url('terms-of-use') }}" target="_blank" class="text-primary">Terms of Use</a>, <a href="{{ url('privacy') }}" target="_blank" class="text-primary">Privacy Policy</a> and <a href="{{ url('cookie-policy') }}" target="_blank" class="text-primary">Cookie Policy</a></label>
                            </div>
                        </div>
                        <div class="text-center form-group mt20">
                            {{ Form::submit('Create My Account', ['class' => 'btn btn-primary'] )  }}
                        </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
@stop