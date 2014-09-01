@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	<div class="row">
	    <div class="col10 push1">
	    <div class="mb30" id="findByName">
	        {{ Form::text('findByName', null, ['placeholder' => 'start typing the class name']) }}
	    </div>

        @foreach($evercisegroups as $evercisegroup)
            <div class="selectors" id="{{Str::lower($evercisegroup->name)}}">
                {{ Form::open(array('id' => 'edit_classes', 'url' => 'admin/edit_classes/'.$evercisegroup->id, 'method' => 'post', 'class' => 'create-form')) }}
                <h4>{{ $evercisegroup->name }}</h4>
                <div class="col1">{{ Form::label('featured', 'Featured?') }}</div>

                <div class="col1 mt15">{{ Form::checkbox('featured',1, isset($evercisegroup->featuredClasses)? true: false) }}</div>



                <div class="col10">

                    @include('widgets.autocomplete-category', ['fieldname'=>'category1', 'label'=>'category 1', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>0 ? $evercisegroup->subcategories[0]->name : ''])
                    @include('widgets.autocomplete-category', ['fieldname'=>'category2', 'label'=>'category 2', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>1 ? $evercisegroup->subcategories[1]->name : ''])
                    @include('widgets.autocomplete-category', ['fieldname'=>'category3', 'label'=>'category 3', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>2 ? $evercisegroup->subcategories[2]->name : ''])

                    {{ Form::submit('update', ['class' => 'btn btn-yellow mb40']) }}
                </div>
                {{ Form::close() }}

            </div>

        @endforeach
        </div>

	</div>

@stop