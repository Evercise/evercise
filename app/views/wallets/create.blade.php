<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Confirm withdrawal</h4>
		<br>
	</div>
	
	<div class="modal-body">
		{{ Form::open(array('id' => 'withdrawal-confirmation', 'url' => 'wallets/update', 'method' => 'PUT', 'class' => 'update-form')) }}
			<div class="col4">
				Withdrawal amount: 
				{{ Form::text( 'withdrawal' , $withdrawal, array( 'placeholder' => 'enter amount', 'maxlength' => 5, 'id' => 'withdrawal')) }}
		
			</div>
			<div class="col4">
				Paypal account: 
				{{ Form::text( 'paypal' , $paypal, array( 'placeholder' => 'enter paypal account', 'maxlength' => 50, 'id' => 'paypal')) }}
			</div>
			<div class="col3">
				<div class="grey-box">
				</div>
				{{ Form::submit('Confirm Withdrawal' , array('class'=>'btn-yellow ')) }}
			</div>
				
			
	    {{ Form::close() }}
    </div>

</div>