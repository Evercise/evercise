<div class="dashboard-title">
	<div class="left">
		<h6>Current balance</h6>
		<h1 class="highlight">&pound;{{ $balance }}</h1>
	</div>
	<div class="right">
		<br>
		<br>
		<strong>Earnings this month: </strong>
		<h5>&pound;{{ $earningsThisMonth }}</h5>

		<br>
		<br>
		<strong>Earnings last month: </strong>
		<h5>&pound;{{ $earningsLastMonth }}</h5>
	</div>
	
	
</div>
<div class="dashboard-body">
	<h3>Transactions</h3>
	<br>
	<br>
	<div class="table">
		<div class="table-row">
			<div class="table-head table-field two-s align-l">
				<li>Description</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Date</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Amount In</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Out</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Balance</li>
			</div>
		</div>

		@foreach($history as $record)
			<div class="table-row">
				@if($record->transaction_amount > 0)
					<div class="table-field two-s align-l">
						<li>Deposit</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ date('d/m/Y', strtotime($record->created_at) ) }}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							&pound;{{ $record->transaction_amount}}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							&pound;{{ $record->new_balance }}
						</li>
					</div>
				@else
					<div class="table-field two-s align-l">
						<li>Withdrawal</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ date('d/m/Y', strtotime($record->created_at) ) }}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							&pound;{{ $record->transaction_amount}}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							&pound;{{ $record->new_balance }}
						</li>
					</div>
				@endif
			</div>
		@endforeach
	</div>
</div>
<div class="dashboard-body">
	<h3>Paypal details</h3>
	<hr>

	{{ Form::open(array('id' => 'paypalform', 'url' => 'wallets/'.$user->id.'/update_paypal', 'method' => 'POST', 'class' => 'update-form')) }}

		@if($paypal != '')
			@include('form.textfield', array('fieldname'=>'updatepaypal', 'default' => $paypal,  'placeholder'=>'enter paypal email', 'maxlength'=>50, 'label'=>'Withdrawal Method', 'fieldtext'=> null ))
		@else
			@include('form.textfield', array('fieldname'=>'updatepaypal', 'placeholder'=>'enter paypal email', 'maxlength'=>50, 'label'=>'Withdrawal Method', 'fieldtext'=> null ))
		@endif 
		

		{{ Form::submit('Update paypal account' , array('class'=>'btn btn-green mt10')) }}
	{{ Form::close() }}
</div>


<div class="dashboard-body">
	<h3>Withdrawal </h3>
	<p>{{ $paypal != '' ? 'Using - '.$paypal : 'Please add your paypal deatils above'}}</p>
	<hr>


	{{ Form::open(array('id' => 'withdrawalform', 'url' => 'wallets/'.$user->id.'/edit', 'method' => 'GET', 'class' => 'update-form')) }}

	 @include('form.textfield', array('fieldname'=>'withdrawal', 'default'=>  $balance ,'placeholder'=>'enter amount', 'maxlength'=>7, 'label'=>'Amount to Withdraw', 'fieldtext'=> null ))

		
		{{ Form::hidden( 'paypal' , $paypal, array('id' => 'paypal')) }}
		@if($paypal != '')
			{{ Form::submit('Withdraw' , array('class'=>'btn btn-yellow mt10')) }}
		@else
			{{ Form::submit('Withdraw' , array('class'=>'btn btn-yellow disabled mt10')) }}
		@endif
	{{ Form::close() }}


</div>

