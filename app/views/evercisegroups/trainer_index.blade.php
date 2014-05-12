@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>'5'))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))

	<div class="hub-wrapper">
		@foreach ($evercisegroups as $key=>$value)
			<div class="hub-row">
				<div class="hub-title"><h4>{{ $value }}</h4></div>
				<div class="hub-block">		
					<li>{{ HTML::linkRoute('sessions.create', 'Add date', null, array('id'=>$key, 'class' => 'add_session')) }}</li>	
				</div>
				<div class="hub-block">
					h
				</div>
				<div class="hub-block">
					h
				</div>
			</div>
		@endforeach
		
		
	</div>


	<div class="hub-calendar-wrapper">
		@include('widgets.calendar', array('month'=>$month, 'year'=>$year))
	</div>

@stop