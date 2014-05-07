@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	Trainer View
	@foreach ($evercisegroups as $eg)
		<p>{{ $eg }}</p>
		<a href=''>update</a>
		{{ Form::open(array('id' => 'session_new', 'url' => 'evercisegroups', 'method' => 'post', 'class' => 'create-form')) }}

		@include('form.hidden', array('fieldname'=>'evercisegroup', 'value'=>$eg))
		@include('form.hidden', array('fieldname'=>'date', 'value'=>'07-07-14'))
		{{ Form::submit('Add date' , array('class'=>'btn-yellow ')) }}
        {{ Form::close() }}
	@endforeach

@stop