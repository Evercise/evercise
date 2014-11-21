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
                    <strong>Your account has been created, just a few more details and then you can create classes.</strong>
                </div>

               <div class="form-group mb50">
                    @include('v3.widgets.profile_image_upload')

               </div>
                {{ Form::open(['url' => 'ajax/trainers/store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'register-form'] ) }}
                   <div class="form-group mb50">
                        {{ Form::label('profession', 'Add your Profession', ['class' => 'mb15'] )  }}
                        {{ Form::text('profession', null, ['class' => 'form-control', 'placeholder' => 'Max 50 Characters', 'maxlength' => 50]) }}
                   </div>
                   <div class="form-group mb50">
                        {{ Form::label('profession', 'Add your Bio', ['class' => 'mb15'] )  }}
                        {{ Form::textarea('bio', null, ['class' => 'form-control', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
                   </div>
                   <div class="form-group mb50">

                    <label class="mb15" for="phone">Add your website</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                          <span class="ml10 mr10">http://</span>
                        </div>
                        {{ Form::text('website', null, ['class' => 'form-control']) }}
                    </div>


                    <div class="text-center mt50">
                        {{ Form::hidden('image', null, ['id' => 'image']) }}
                        {{ Form::submit('Finish Up', ['class' => 'btn btn-primary'] )  }}
                    </div>

                  </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@stop