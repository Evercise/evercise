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
                <div class="text-center mb50">
                    <strong>Your account has been created, just a few more deatils and then you can create classes.</strong>
                </div>
                {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'mb50', 'role' => 'form'] ) }}
                   <div class="form-group mb50">
                        @include('v3.widgets.profile_image_upload')
                   </div>
                   <div class="form-group mb50">
                        {{ Form::label('profession', 'Add your Profession', ['class' => 'mb15'] )  }}
                        {{ Form::text('profession', null, ['class' => 'form-control', 'placeholder' => 'Max 50 Characters', 'maxlength' => 50]) }}
                   </div>
                   <div class="form-group mb50">
                        {{ Form::label('profession', 'Add your Profession', ['class' => 'mb15'] )  }}
                        {{ Form::textarea('profession', null, ['class' => 'form-control', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
                   </div>
                   <div class="form-group mb50">

                    <label class="mb15" for="phone">Phone Number<small> (Get alerts about classes)</small></label>

                    <div class="input-group">
                        <div class="input-group-addon">
                          <span class="ml10 mr10">http://</span>
                        </div>
                        {{ Form::text('website', null, ['class' => 'form-control']) }}
                    </div>


                    <div class="text-center mt50">
                        {{ Form::submit('Finish Up', ['class' => 'btn btn-primary'] )  }}
                    </div>

                  </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@stop