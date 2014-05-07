@extends('layouts.master')


@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@if($isTrainer)
		Trainer View
		@foreach ($evercisegroups as $eg)
			<p>{{ $eg }}</p>
		@endforeach
	@else
		User View
	@endif

@stop