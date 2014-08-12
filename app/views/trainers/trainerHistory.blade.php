@foreach ($historys as $key => $history) 
	<div class="activity-list activity_{{ $history->historytype_id}}">
		<p>{{ $history->message}}</p>
		<span>{{ date('dS M', strtotime($history->created_at))  }}</span>

	</div>	
@endforeach

<div class="mt20 ml10 float-right">
	{{ $historys->links() }}
</div>
