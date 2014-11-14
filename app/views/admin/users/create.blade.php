@extends('admin.main')

@section('css')
@stop

@section('script')


@stop

@section('body')

<div class="row">

@if(isset($messages)) {
    <ul>
        @foreach($messages->all('<li>:message</li>') as $message)
        {{ $message }}
        @endforeach
    </ul>
@endif
             <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                   {{ Form::open(['route' => 'admin.users.trainerStore', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'register-form'] ) }}

                   {{ Form::hidden('trainer', 'yes') }}


                       <div class="row  mt10">
                           <div class="col-sm-6">
                              <div class="form-group mb50">
                                {{ Form::label('first_name', 'Forename', ['class' => 'mb15'] )  }}
                                {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Trainers first name']) }}
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group mb50">
                                {{ Form::label('last_name', 'Surname' , ['class' => 'mb15'])  }}
                                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Trainers second name']) }}
                              </div>
                           </div>
                       </div>
                       <div class="row  mt10">
                           <div class="col-sm-6">
                              <div class="form-group mb50">
                                {{ Form::label('display_name', 'Evercise Display Name', ['class' => 'mb15'] )  }}
                                {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'This will be the trainers name on Evercise']) }}
                                 <!--<em class="help-block">evercise.com/users/</em>-->
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group mb50">
                                {{ Form::label('email', 'Email Address', ['class' => 'mb15'] )  }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Trainers current email address']) }}
                              </div>
                           </div>
                       </div>
                        <div class="row  mt10">
                            <div class="col-sm-6">
                                <label class="mb15" for="phone">Phone Number<small> (Get alerts about classes)</small></label>

                                <div class="input-group">
                                    <div class="input-group-addon custom-select">
                                       {{ Form::select('area_code',
                                           [
                                               '+44' => '+44',
                                               '+123' => '+123'
                                           ]
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

                         <div class="form-group mb50">
                            {{ Form::label('profession', 'Add  Profession', ['class' => 'mb15'] )  }}
                            {{ Form::textarea('profession', null, ['class' => 'form-control', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
                       </div>

                         <div class="form-group mb50">
                            {{ Form::label('bio', 'Add  Bio', ['class' => 'mb15'] )  }}
                            {{ Form::textarea('bio', null, ['class' => 'form-control', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
                       </div>
                       <div class="form-group mb50">

                        <label class="mb15" for="phone">Website</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                              <span class="ml10 mr10">http://</span>
                            </div>
                            {{ Form::text('website', null, ['class' => 'form-control']) }}
                        </div>


                        <div class="text-center">
                            <label class="custom-checkbox">
                                {{ Form::checkbox('newsletter', 'yes', true ) }}

                                 Get all the latest deals and news info by signing up to our newsletter
                            </label>
                        </div>





                        <div class="text-center form-group">
                            {{ Form::submit('Create Trainer Account', ['class' => 'btn btn-primary'] )  }}
                        </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>



@stop