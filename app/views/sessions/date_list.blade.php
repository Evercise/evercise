<aside>
	<h5>Class Stats</h5>
	<p>Past Dates <span>{{ count($pastsessions)}} </span></p>
	<p>Upcoming Dates <span>{{ count($futuresessions)}} </span></p>

	<div  class="stat-wrapper">
		<p>Places Filled</p>
		<div class="donut-chart">

			@if ($totalCapacity[$key] == 0 ) 
				<br>
				<p>No Upcoming Sessions</p>
			@else
				@include('widgets.donutChart', array('label' => null, 'width' => 100 , 'id' => 'total-members-bookings-'.$key, 'total' => $totalCapacity[$key], 'fill' => isset($totalMembers[$key]) ? array_sum($totalMembers[$key]) : 0 ))
			@endif			
		</div>
	</div>
	
</aside>

<aside>
	<h5>Upcoming Dates</h5>
	<ul>
		@if(count($futuresessions) >= 1)

			@foreach ($futuresessions as $fs => $futuresession) 
				@if(count($futuresession->sessionmembers) == 0)
				<li>{{ date(' h:ia M-dS' ,strtotime($futuresession->date_time)) }}{{ HTML::link('sessions/' . $futuresession->id , 'x',array('class' => 'session-delete', 'id' => 'delete-session-'.$evercisegroupId.'-'.$futuresession->id)) }}</li>
				@else
					<li>{{ date(' h:ia M-dS' ,strtotime($futuresession->date_time)) }}</li> 
				@endif
			@endforeach
		@else
			No Upcoming Dates
		@endif
	</ul>
	
</aside>
