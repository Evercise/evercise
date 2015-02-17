@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <div class="row text-center">
            <div class="underline">
                <h1>Create a class</h1>
            </div>
        </div>
        <div class="row mt50 mb50">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group mb15">
                    {{ Form::open(['route' => 'ajax.gallery.getdefaults', 'method' => 'post', 'id' => 'find_gallery_image_by_category']) }}
                        {{ Form::label('category-select', 'Category', ['class' => 'mb15'] ) }}
                        {{ Form::select('keywords-select', $subcategories, isset($cloneGroup) ? $cloneGroup->getSubcategoryIds() : '', ['class' => 'form-control mb40 select2', 'multiple' ] ) }}
                        {{ Form::hidden('keywords',null) }}
                    {{ Form::close() }}
                </div>
                <div class="form-group mb50">
                    @include('v3.widgets.class_image_upload')
                </div>
                {{ Form::open(['route' => 'evercisegroups.store', 'method' => 'post', 'role' => 'form', 'id' => 'create-class'] ) }}
                    <div class="form-group mb50">
                        {{ Form::label('class_name', 'Name of your Class', ['class' => 'mb15 required' , 'form' => 'create-class'] )  }}
                        {{ Form::text('class_name', isset($cloneGroup) ? $cloneGroup['name'] : '', ['class' => 'form-control', 'placeholder' => 'Max 50 Characters', 'maxlength' => 50, 'form' => 'create-class']) }}
                    </div>
                    <div class="form-group mb50">
                        {{ Form::label('class_description', 'Class Description', ['class' => 'mb15', 'form' => 'create-class'] )  }}
                        {{ Form::textarea('class_description', isset($cloneGroup) ? $cloneGroup['description'] : '', ['class' => 'form-control required', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7, 'form' => 'create-class']) }}
                    </div>
                    <div class="form-group mb50">
                        {{ Form::label('venue_select', 'Venue', ['class' => 'mb15', 'form' => 'create-class'] ) }}
                        <div class="input-group">

                            <div class="custom-select">
                                {{ Form::select('venue_select', $venues , isset($cloneGroup) ? $cloneGroup->venue_id : '', ['class' => 'form-control', 'form' => 'create-class'] ) }}
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#create-venue">
                                     Create a new Venue
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 text-right sm-text-center">
                            {{ Html::linkRoute('users.edit', 'Cancel', $user->display_name, ['class' => 'btn btn-default sm-btn-block sm-mb10']) }}
                        </div>
                        {{ Form::hidden('image', isset($cloneGroup->image) ? $cloneGroup->image : null) }}
                        {{ Form::hidden('gallery_image', false) }}
                        {{ Form::hidden('category_array[]',null ) }}
                        <div class="col-sm-6 sm-text-center">{{ Form::submit('Next step', ['class' => 'btn btn-primary sm-btn-block', 'form' => 'create-class'] )  }}</div>
                    </div>
                {{Form::close()}}


            </div>
        </div>
    </div>
    @include('v3.venue.create')
@stop