@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@foreach($evercisegroups as $evercisegroup)

        {{ Form::open(array('id' => 'venue_create', 'url' => 'venues', 'method' => 'post', 'class' => 'create-form')) }}
        <p>{{ $evercisegroup->name }}</p>

        @include('form.textfield', array('fieldname'=>'stars', 'placeholder'=>'stars', 'maxlength'=>10, 'label'=>'stars', 'default' => 5 ))
        @include('form.textfield', array('fieldname'=>'comment', 'placeholder'=>'comment', 'maxlength'=>10, 'label'=>'comment', 'default' => '' ))
        

        {{ Form::close() }}
		
	@endforeach

@stop