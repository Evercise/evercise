@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	Trainer View
	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>'5'))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))
	@foreach ($evercisegroups as $key=>$val)
		<p>{{ $evercisegroups[$key] }}</p>
		<li>{{ HTML::linkRoute('sessions.create', 'Add date', null, array('id'=>$key, 'class' => 'add_session')) }}</li>
	@endforeach

	@include('widgets.calendar', array('month'=>$month, 'year'=>$year))

@stop