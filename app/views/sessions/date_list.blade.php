<aside>
	<h5>Class Stats</h5>
	<p>
		@if (!empty($pastDates[$key]))
			@if (count($pastDates[$key]) == 1) 
				Past Dates <span>{{ count($pastDates[$key])}} </span>
			@else
				Past Dates <span>{{ count($pastDates[$key])}}</span>
			@endif
		@else
			Past Dates <span>0</span>
		@endif
	</p>
	<p>
		@if (!empty($futureDates[$key]))
			@if (count($futureDates[$key]) == 1) 
				Upcoming Dates <span>{{ count($futureDates[$key])}} </span>
			@else
				Upcoming Dates <span>{{ count($futureDates[$key])}} </span>
			@endif
		@else
			Upcoming Dates <span>0</span>
		@endif

	</p>
	<div  class="stat-wrapper">
		<p>Places Filled</p>
		<div class="donut-chart">
		@if(isset($totalMembers[$key]))
			@include('widgets.donutChart', array('label' => null, 'width' => 100 , 'id' => 'total-members-bookings-'.$key,'total' => $totalCapacity[$key], 'fill' => array_sum($totalMembers[$key]) ))

		@else
			@include('widgets.donutChart', array('label' => null, 'width' => 100 , 'id' => 'total-members-bookings-'.$key,'total' => $totalCapacity[$key], 'fill' => 0 ))
		@endif

			
		</div>
	</div>
	
</aside>

<aside>
	<h5>Upcoming Dates</h5>
	<ul>
		@if (!empty($futureDates[$key]))
			@foreach ($futureDates[$key] as $k => $futurevalue)
			<li>{{ $futurevalue }} {{ HTML::link('sessions/' . $k , 'x',array('class' => 'session-delete', 'id' => 'delete-session-'.$key.'-'.$k,  'EGindex'=>$key)) }}</li>
				
			@endforeach
		@else
			No Upcoming Dates
		@endif
	</ul>
	
</aside>
