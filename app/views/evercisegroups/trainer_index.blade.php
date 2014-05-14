@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))
	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>$evercisegroups[0]->id))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))

	<div class="hub-wrapper">
		@foreach ($evercisegroups as $key=>$value)
			<div class="hub-row
			@if($key == 0)
			selected
			@endif
			" data-id="{{ $value['id'] }}">
				<div class="hub-title"><h4>{{ $value['name'] }}</h4></div>
				<div class="hub-block">		
					<li>{{ HTML::linkRoute('sessions.create', 'Add date', null, array('id'=>$key, 'class' => 'add_session')) }}</li>	
				</div>
				<div class="hub-block">
					@include('layouts.classBlock', array('title' => $value['name'] , 'description' =>$value['description'] ,  'image' => 'profiles/'.$directory .'/'. $value['image'], 'sessionDates' => $sessionDates[$key] ))
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