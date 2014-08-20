@extends('layouts.master')

@section('content')

	<div class="full-width">
		<div id="class-info-image" class="full-width-one-q">
			<div class="class-thumb">
				<div class="class-thumb-wrap">
					{{ HTML::image('/profiles/'.$directory .'/'. $evercisegroup->image, 'class image' , array('class' => 'class-thumb-img')); }}
				</div>
			</div>
		</div>
		<div id="class-info" class="full-width-three-q">
			<h3>{{ $evercisegroup->name }}</h3>
			<p>{{ $evercisegroup->description }}</p>
			<br/>
			<p>Gender: 
				@if ($evercisegroup->gender == 0) Unisex
				@elseif ($evercisegroup->gender == 1) Male
				@elseif ($evercisegroup->gender == 2) Female
				@endif
			</p>
		</div>
		<hr class="col12">
		@if($members)
		<!-- chart s to display members info when done -->
		<div class="row12">
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Total Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings1','total' => $totalCapacity, 'fill' => $totalSessionMembers ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Average Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings2','total' => $averageCapacity, 'fill' => $averageSessionMembers ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Total Class Revenue', 'width' => 120 , 'id' => 'total-class-bookings3','total' => $totalRevenue, 'fill' => $revenue ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Average Class Revenue', 'width' => 120 , 'id' => 'total-class-bookings4','total' => $averageTotalRevenue, 'fill' => $averageRevenue ))
			</div>
		
		</div>

		<hr class="col12">

		<div class="col12">
			<h3>Upcoming Sessions</h3>
		</div>
		<div class="session-table">
			<li class="hd">Class Date</li>
			<li class="hd">Start Time</li>
			<li class="hd">End Time</li>
			<li class="hd">Price Per Person</li>
			<li class="hd">Places Filled</li>
			<li class="hd">Options</li>
			
			@foreach ($evercisegroup['Evercisesession'] as $s_key => $session)
				@if((new DateTime($session['date_time'])) > (new DateTime('now')))
					@include('sessions.show')
				@endif
			@endforeach
		</div>

		<div class="col12">
		<br>
		<br>
			<h3>Past Sessions</h3>
		</div>
		<div class="session-table session-table-past">
			<li class="hd">Class Date</li>
			<li class="hd">Start Time</li>
			<li class="hd">Price Per Person</li>
			<li class="hd">Places Filled</li>
			<li class="hd">Status</li>
			<li class="hd">Commission</li>
			<li class="hd">Total revenue</li>
			<li class="hd">Options</li>
			
			@foreach ($evercisegroup['Evercisesession'] as $s_key => $session)
				@if((new DateTime($session['date_time'])) < (new DateTime('now')))
					@include('sessions.show')
				@endif
			@endforeach
		</div>
		
		@else
			<div class="col12">
				<div class="session-table"><p>No members have signed up for this class yet</p></div>
			</div>
		@endif

	</div>






@stop