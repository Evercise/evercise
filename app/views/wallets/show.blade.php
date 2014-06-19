

	
	<div>
		{{ $balance }}
	</div>
	<br/>
	<br/>
	<br/>
	<div>
		History:
		@foreach($history as $record)
			<div>
				{{ 'Transaction amount: ' . $record->transaction_amount . ', balance: ' . $record->transaction_amount . ', date: ' . $record->created_at }}
			</div>
		@endforeach
	</div>


