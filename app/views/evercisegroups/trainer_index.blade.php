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
			<div class="hub-row
			@if($key == 0)
			selected
			@endif
			" data-id="{{ $value['id'] }}" data-name="{{ $value['name'] }}"  data-duration="{{ $value['default_duration'] }}">
				<div class="hub-title"><h4>{{ $value['name'] }}</h4></div>
				<div class="hub-block">
				{{ HTML::link('evercisegroups/clone_evercise_groups/'.$value['id'], 'Clone Class!' ,array('class' => 'btn btn-yellow')) }}
				{{ HTML::linkRoute('evercisegroups.create', 'Delete Class!',null ,array('class' => 'btn btn-red')) }}
				{{ HTML::linkRoute('evercisegroups.create', 'View Participants',null ,array('class' => 'btn btn-blue')) }}
				</div>
				<div class="hub-block">
					@include('layouts.classBlock', array('title' => $value['name'] , 'description' =>$value['description'] ,  'image' => 'profiles/'.$directory .'/'. $value['image'],  'distance' => $miles[$key], 'default_price' => $value['default_price'], 'default_size' => $value['capacity']  ))
				</div>
				<div class="hub-block">
					<h5>This class has:</h5>

					@if (!empty($pastDates[$key]))
						@if (count($pastDates[$key]) == 1) 
							{{ count($pastDates[$key])}} past date
						@else
							{{ count($pastDates[$key])}} past dates
						@endif
					@else
						0 past dates
					@endif

					<br>

					 
					@if (!empty($futureDates[$key]))
						@if (count($futureDates[$key]) == 1) 
							{{ count($futureDates[$key])}} upcoming date
						@else
							{{ count($futureDates[$key])}} upcoming dates
						@endif
					@else
						0 upcoming dates
					@endif

					
					<br>
					<br>
					<h5>Upcoming dates:</h5>
					<br>
					@if (!empty($futureDates[$key]))
						@foreach ($futureDates[$key] as $key => $value)
							{{ $value}}<br>
						@endforeach
					@else
						No Upcoming Dates
					@endif
					
				</div>
			</div>
		@endforeach	
	</div>


	<div class="hub-calendar-wrapper">
		@include('widgets.calendar', array('month'=>$month, 'year'=>$year))
	</div>

@stop