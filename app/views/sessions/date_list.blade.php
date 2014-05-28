
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
	@foreach ($futureDates[$key] as $k => $futurevalue)
		{{ HTML::link('sessions/' . $k , 'x',array('class' => 'session-delete',  'EGindex'=>$key)) }} {{ $futurevalue }}<br>
	@endforeach
@else
	No Upcoming Dates
@endif