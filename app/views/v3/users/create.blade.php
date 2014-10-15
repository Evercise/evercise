@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <div class="row text-center">
            <div class="underline">
                <h1>Register</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'mb50', 'role' => 'form'] ) }}
                        <div>
                           {{ Form::label('trainer-question', 'Are you a trainer?', ['class' => 'col-sm-3 col-sm-offset-3 control-label text-right'])  }}
                           <div class="col-sm-6 mb20">
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'yes', true) }}
                                 Yes
                               </label>
                               <label class="custom-checkbox">
                                 {{ Form::radio('trainer', 'no') }}
                                 No
                               </label>
                           </div>
                        </div>
                        <div class="mb20 text-center">
                            {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-fb"></span>Log in with facebook', null , ['class' => 'btn btn-lg btn-fb']) )}}

                        </div>
                        <div class="col-sm-6 mt10">

                           <div class="form-group mb50">
                             {{ Form::label('forename', 'Forename', ['class' => 'mb15'] )  }}
                             {{ Form::text('forename', null, ['class' => 'form-control', 'placeholder' => 'Enter your first name']) }}
                           </div>
                           <div class="form-group mb50 required">
                             {{ Form::label('display_name', 'Your Evercise Display Name', ['class' => 'mb15'] )  }}
                             {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'This will be your name on Evercise']) }}
                             <em class="help-block">evercise.com/users/</em>
                           </div>
                           <div class="form-group mb50 required">
                             {{ Form::label('password', 'Password' , ['class' => 'mb15'])  }}
                             {{ Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter a password']) }}
                           </div>

                           <div class="form-group mb50">

                             <label class="mb15" for="phone">Phone Number<small> (Get alerts about classes)</small></label>

                             <div class="input-group">
                                 <div class="input-group-addon custom-select">
                                    {{ Form::select('phone',
                                        [
                                            '+44' => '+44',
                                            '+123' => '+123'
                                        ]
                                     , '+44', ['class' => 'select-addon'] ) }}
                                 </div>
                                 {{ Form::text('phone', null, ['class' => 'form-control']) }}
                            </div>

                           </div>

                        </div>
                        <div class="col-sm-6 mt10">
                          <div class="form-group mb50">
                            {{ Form::label('surname', 'Surname' , ['class' => 'mb15'])  }}
                            {{ Form::text('surname', null, ['class' => 'form-control', 'placeholder' => 'Enter your second name']) }}
                          </div>
                          <div class="form-group mb50 required">
                              {{ Form::label('email', 'Email Address', ['class' => 'mb15'] )  }}
                              {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your current email address']) }}
                          </div>
                          <div class="form-group mb50 required">
                            {{ Form::label('confirmed_email', 'Confirmed Password' , ['class' => 'mb15'])  }}
                            {{ Form::email('confirmed_email', null, ['class' => 'form-control', 'placeholder' => 'confirm your password']) }}
                          </div>
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
                        <div class="text-center">
                            <label class="custom-checkbox">
                                {{ Form::checkbox('newsletter', 'yes', true ) }}

                                 Get all the latest deals and news info by signing up to our newsletter
                            </label>

                        </div>
                        <div class="text-center">
                            {{ Form::submit('Create My Account', ['class' => 'btn btn-primary'] )  }}
                        </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
@stop