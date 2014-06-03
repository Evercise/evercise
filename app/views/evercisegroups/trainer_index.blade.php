@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=> $displayName.'&apos;s class hub', 'subtitle'=>'Manage your classes from'))
	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>$evercisegroups[0]->id))
	@include('form.hidden', array('fieldname'=>'evercisegroupName', 'value'=>$evercisegroups[0]->name))
	@include('form.hidden', array('fieldname'=>'originalprice', 'value'=>$evercisegroups[0]->default_price))
	@include('form.hidden', array('fieldname'=>'evercisegroupDuration', 'value'=>$evercisegroups[0]->default_duration))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))
	
	<div class="btn-wrapper">
		{{ HTML::linkRoute('evercisegroups.create', 'Create a new class!',null ,array('class' => 'btn-blue ')) }}
    </div>
	<div class="hub-wrapper">
		@foreach ($evercisegroups as $key=>$value)
			<div class="hub-row {{ ($key == 0) ? 'selected' : '' }}" data-id="{{ $value['id'] }}" data-name="{{ $value['name'] }}"  data-duration="{{ $value['default_duration'] }}">
				<div class="hub-title"><h4>{{ $value['name'] }}</h4></div>
				<div class="hub-block">
				{{ HTML::link('evercisegroups/clone_evercisegroup/'.$value['id'], 'Clone Class!' ,array('class' => 'btn btn-yellow')) }}
				{{ HTML::link('evercisegroups/delete_evercisegroup/'.$value['id'], 'Delete Class!',array('class' => 'btn btn-red')) }}
				{{ HTML::linkRoute('sessions.index', 'View Participants',$value['id'] ,array('class' => 'btn btn-blue')) }}
				</div>
				<div class="hub-block">
					@include('layouts.classBlock', array('evercisegroupId' => $value['id'],'title' => $value['name'] , 'description' =>$value['description'] ,  'image' => 'profiles/'.$directory .'/'. $value['image'],  'distance' => $miles[$key], 'default_price' => $value['default_price'], 'default_size' => $value['capacity'] ))
				</div>
				<div class="hub-block date-list" id="date-list-{{ $key }}">
					@include('sessions.date_list' , array( 'ids' => $value['Evercisesession'] ))
				</div>
			</div>
		@endforeach	
	</div>


	<div class="hub-calendar-wrapper">
		<div id="calendar-wrapper">
			@include('widgets.calendar', array('month'=>$month, 'year'=>$year))
		</div>
	</div>

@stop