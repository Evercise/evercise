@extends('layouts.master')

@section('content')

	@include('layouts.pagetitle', array('title'=> trans('evercisegroups-trainer_index.title', ['name'=>$user->display_name]), 'subtitle'=>trans('evercisegroups-trainer_index.subtitle')))
	@include('form.hidden', array('fieldname'=>'evercisegroupId', 'value'=>$evercisegroups[0]->id))
	@include('form.hidden', array('fieldname'=>'evercisegroupName', 'value'=>$evercisegroups[0]->name))
	@include('form.hidden', array('fieldname'=>'originalprice', 'value'=>$evercisegroups[0]->default_price))
	@include('form.hidden', array('fieldname'=>'evercisegroupDuration', 'value'=>$evercisegroups[0]->default_duration))
	@include('form.hidden', array('fieldname'=>'year', 'value'=>$year))
	@include('form.hidden', array('fieldname'=>'month', 'value'=>$month))
	@include('form.hidden', array('fieldname'=>'date', 'value'=>''))
	
	<div class="hub-top">
		<h3>{{Lang::choice('general.class', 2)}}</h3>
		{{ HTML::linkRoute('evercisegroups.create', trans('evercisegroups-trainer_index.create_a_new_class'),null ,array('class' => 'btn btn-yellow ')) }}
	</div>
    <div class="hub-header">
		<div class="hub-header-col large">{{Lang::choice('general.class', 1)}}</div>
		<div class="hub-header-col">{{trans('evercisegroups-trainer_index.preview')}}</div>
		<div class="hub-header-col cal">{{Lang::choice('general.class', 1)}} {{trans('evercisegroups-trainer_index.dates')}}</div>
	</div>
	<div class="hub-wrapper">

		@foreach ($evercisegroups as $key=>$evercisegroup)
			<div class="hub-row {{ ($key == 0) ? 'selected' : '' }}" data-id="{{ $evercisegroup['id'] }}" data-name="{{ $evercisegroup['name'] }}"  data-duration="{{ $evercisegroup['default_duration'] }}">
				
				<div class="hub-block">
					<div class="hub-title">
						<h3>{{ $evercisegroup['name'] }}</h3>
						{{ HTML::linkRoute('class.show', Lang::choice('general.class', 1).' '.trans('general.details'),$evercisegroup['id'] ,array('class' => 'btn btn-blue')) }}
					</div>
					
					
					
					<div class="date-list" id="date-list-{{ $key }}">
					
						@include('sessions.date_list' , array( 'evercisegroupId' => $evercisegroup['id'], 'ids' => $evercisegroup['Evercisesession'] , 'futuresessions' => $evercisegroup->futuresessions , 'pastsessions' => $evercisegroup->pastsessions ))
					</div>
					<div class="hub-buttons">
					<a href="evercisegroups/clone_evercisegroups/{{$evercisegroup['id']}}" class="btn btn-green">{{trans('general.clone')}} {{Lang::choice('general.class', 1)}}{{ HTML::image('/img/clone_icon_white.png', 'clone icon' , array('class' => 'evercisegroup-icon')) }}</a>
					<a href="evercisegroups/delete/{{$evercisegroup['id']}}" class="btn btn-red" id="delete_group">{{trans('general.delete')}} {{Lang::choice('general.class', 1)}} <span>X</span></a>
					</div>

					
				</div>
				<div class="class-hub-block">
					@include('layouts.classBlock', array('evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name ,  'venue' => $evercisegroup->venue  ,   'image' => 'profiles/'.$directory .'/'. $evercisegroup->image,   'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity, 'rating' => isset($stars[$evercisegroup->id])?  array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]) : 0 , ))

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