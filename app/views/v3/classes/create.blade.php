@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <div class="row text-center">
            <div class="underline">
                <h1>Create a class</h1>
            </div>
            <strong>Some type of instructions for the trainer to continue</strong>
        </div>
        <div class="row mt50 mb50">
            <div class="col-sm-8 col-sm-offset-2">
                {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'mb50', 'role' => 'form'] ) }}
                {{Form::close()}}
                    <div class="form-group mb15">
                        {{ Form::label('category-select', 'Category', ['class' => 'mb15'] ) }}
                        {{ Form::select('category-select', $subcategories, '', ['class' => 'form-control mb40 select2', 'multiple'] ) }}
                    </div>
                    <div class="form-group mb15">
                        @include('v3.widgets.class_image_upload')

                    </div>
                    <div class="form-group mb50">
                        {{ Form::label('class-name', 'Name of your Class', ['class' => 'mb15'] )  }}
                        {{ Form::text('class-name', null, ['class' => 'form-control required', 'placeholder' => 'Max 50 Characters', 'maxlength' => 50]) }}
                    </div>
                    <div class="form-group mb50">
                        {{ Form::label('class-description', 'Class Description', ['class' => 'mb15'] )  }}
                        {{ Form::textarea('class-description', null, ['class' => 'form-control required', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
                    </div>
                    <div class="form-group mb50">
                        {{ Form::label('venue-select', 'Venue', ['class' => 'mb15'] ) }}
                        <div class="input-group">

                            <div class="custom-select">
                                {{ Form::select('venue-select', $venues , '', ['class' => 'form-control '] ) }}
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#create-venue">
                                     Create a new Venue
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 text-right"><button class="btn btn-default">Cancel</button> </div>
                        <div class="col-sm-6">{{ Form::submit('Next step', ['class' => 'btn btn-primary'] )  }}</div>
                    </div>


            </div>
        </div>
    </div>



    @include('v3.venue.create')
@stop