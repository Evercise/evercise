

	
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
				{{ 'Transaction amount: ' . $record->transaction_amount . ', balance: ' . $record->new_balance . ', date: ' . $record->created_at }}
			</div>
		@endforeach
	</div>


