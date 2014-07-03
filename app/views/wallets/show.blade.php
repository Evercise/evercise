

	
	<div>
		Balance: {{ $balance }}
	</div>
	<br/>
	<br/>
	<br/>
	<div>
		History:
		@foreach($history as $record)
			<div>
			@if($record->transaction_amount > 0)
				{{ 'Deposit: ' . ($record->transaction_amount) . ', balance: ' . $record->new_balance . ', date: ' . $record->created_at }}
			@else
				{{ 'Withdrawal: ' . (-$record->transaction_amount) . ', balance: ' . $record->new_balance . ', date: ' . $record->created_at }}
			@endif
			</div>
		@endforeach
	</div>
	<br/>
	<br/>
	<br/>
	<div>

		{{ Form::open(array('id' => 'paypalform', 'url' => 'wallets/'.$user->id.'/update_paypal', 'method' => 'POST', 'class' => 'update-form')) }}
			{{ Form::text( 'updatepaypal' , '', array( 'placeholder' => 'Change paypal account', 'maxlength' => 50, 'id' => 'updatepaypal')) }}
			{{ Form::submit('Update paypal account' , array('class'=>'btn-yellow ')) }}
		{{ Form::close() }}

		<br/>
		<br/>
		<br/>

		{{ Form::open(array('id' => 'withdrawalform', 'url' => 'wallets/'.$user->id.'/edit', 'method' => 'GET', 'class' => 'update-form')) }}
			{{ Form::text( 'withdrawal' , $balance, array( 'placeholder' => 'enter amount', 'maxlength' => 7, 'id' => 'withdrawal')) }}
			<p>Paypal account: {{ $paypal }}</p>
			{{ Form::hidden( 'paypal' , $paypal, array('id' => 'paypal')) }}
			{{ Form::submit('Withdraw funds' , array('class'=>'btn-yellow ')) }}
		{{ Form::close() }}
	</div>


