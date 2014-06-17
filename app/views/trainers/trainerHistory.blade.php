@foreach ($historys as $key => $history) 
	<div class="activity-list activity_{{ $history->historytype_id}}">
		<p>{{ $history->message}}</p>
		<span>{{ date('dS M', strtotime($history->created_at))  }}</span>
	</div>	
@endforeach