@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	Trainer View

		@foreach ($evercisegroups as $key=>$val)
			<p>{{ $evercisegroups[$key] }}</p>
			<li>{{ HTML::linkRoute('sessions.create', 'Add date', null, array('id'=>$key, 'class' => 'add_session')) }}</li>
		@endforeach

		{{ Calendar::generate(2012, 6); }}

@stop