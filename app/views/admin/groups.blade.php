@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@foreach($evercisegroups as $evercisegroup)

        {{ Form::open(array('id' => 'venue_create', 'url' => 'venues', 'method' => 'post', 'class' => 'create-form')) }}
        <p>{{ $evercisegroup->name }}</p>
        
        @include('widgets.autocomplete-category', ['fieldname'=>'category1', 'label'=>'category 1', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>0 ? $evercisegroup->subcategories[0]->name : ''])
        @include('widgets.autocomplete-category', ['fieldname'=>'category2', 'label'=>'category 2', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>1 ? $evercisegroup->subcategories[1]->name : ''])
        @include('widgets.autocomplete-category', ['fieldname'=>'category3', 'label'=>'category 3', 'force'=>1, 'selectedCategory'=>count($evercisegroup->subcategories)>2 ? $evercisegroup->subcategories[2]->name : ''])

        {{ Form::close() }}
		
	@endforeach

@stop