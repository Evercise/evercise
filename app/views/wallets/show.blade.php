

	
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
	<br/>
	<br/>
	<br/>
	<div>
	{{ Form::open(array('id' => 'withdrawalform', 'url' => 'wallets/'.$user->id.'/edit', 'method' => 'GET', 'class' => 'update-form')) }}
		{{ Form::text( 'withdrawal' , '', array( 'placeholder' => 'enter amount', 'maxlength' => 5, 'id' => 'withdrawal')) }}
		{{ Form::text( 'paypal' , '', array( 'placeholder' => 'enter paypal account', 'maxlength' => 50, 'id' => 'paypal')) }}
		{{ Form::submit('Withdraw funds' , array('class'=>'btn-yellow ')) }}
	{{ Form::close() }}
	</div>


