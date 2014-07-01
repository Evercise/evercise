@extends('layouts.master')

@section('title', 'View Classes - Trainer')
@section('content')

	@include('layouts.pagetitle', array('title'=> $user->display_name.'&apos;s class hub', 'subtitle'=>'Manage your classes from here'))
	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>$evercisegroups[0]->id))
	@include('form.hidden', array('fieldname'=>'evercisegroupName', 'value'=>$evercisegroups[0]->name))
	@include('form.hidden', array('fieldname'=>'originalprice', 'value'=>$evercisegroups[0]->default_price))
	@include('form.hidden', array('fieldname'=>'evercisegroupDuration', 'value'=>$evercisegroups[0]->default_duration))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))
	
	<div class="hub-top">
		<h3>Classes</h3>
		{{ HTML::linkRoute('evercisegroups.create', 'Create a new class!',null ,array('class' => 'btn btn-yellow ')) }}
	</div>
    <div class="hub-header">
		<div class="hub-header-col large">Class</div>
		<div class="hub-header-col">Preview</div>
		<div class="hub-header-col cal">Class Dates</div>
	</div>
	<div class="hub-wrapper">

		@foreach ($evercisegroups as $key=>$value)
			<div class="hub-row {{ ($key == 0) ? 'selected' : '' }}" data-id="{{ $value['id'] }}" data-name="{{ $value['name'] }}"  data-duration="{{ $value['default_duration'] }}">
				
				<div class="hub-block">
					<div class="hub-title">
						<h3>{{ $value['name'] }}</h3>
						{{ HTML::linkRoute('evercisegroups.show', 'Class Details',$value['id'] ,array('class' => 'btn btn-blue')) }}
					</div>
					
					
					
					<div class="date-list" id="date-list-{{ $key }}">
					
						@include('sessions.date_list' , array( 'evercisegroupId' => $value['id'], 'ids' => $value['Evercisesession'] , 'futuresessions' => $value->futuresessions , 'pastsessions' => $value->pastsessions ))
					</div>
					<div class="hub-buttons">
					<a href="evercisegroups/clone_evercisegroups/{{$value['id']}}" class="btn btn-green">Clone Class{{ HTML::image('/img/clone_icon_white.png', 'clone icon' , array('class' => 'evercisegroup-icon')) }}</a>
					<a href="evercisegroups/delete/{{$value['id']}}" class="btn btn-red" id="delete_group">Delete Class <span>X</span></a>
					</div>

					
				</div>
				<div class="class-hub-block">
					@include('layouts.classBlock', array('evercisegroupId' => $value['id'],'title' => $value['name'] , 'description' =>$value['description'] ,  'image' => 'profiles/'.$directory .'/'. $value['image'],   'default_price' => $value['default_price'], 'default_size' => $value['capacity'] ))
				</div>
			</div>
			<hr>
		@endforeach	
	</div>


	<div class="hub-calendar-wrapper">
		<div id="calendar-wrapper">
			@include('widgets.calendar', array('month'=>$month, 'year'=>$year))
		</div>
	</div>

@stop