<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Confirm withdrawal</h4>
	</div>
	
	<div class="modal-body modal-center">
		
		<p>Withdrawal amount:  &pound;{{ $withdrawal }}</p>

		<br>
		<p>Paypal account: {{ $paypal }}</p>

				
			
	   
    </div>
    <div class="modal-footer modal-center">
    	{{ Form::open(array('id' => 'withdrawal-confirmation', 'url' => 'wallets/update', 'method' => 'PUT', 'class' => 'update-form')) }}
    		{{ Form::hidden( 'withdrawal' , $withdrawal, array( 'placeholder' => 'enter amount', 'maxlength' => 5, 'id' => 'withdrawal')) }}
			{{ Form::hidden( 'paypal' , $paypal, array( 'placeholder' => 'enter paypal account', 'maxlength' => 50, 'id' => 'paypal')) }}
			{{ Form::submit('Confirm Withdrawal' , array('class'=>'btn btn-yellow ')) }}
		 {{ Form::close() }}
    </div>

</div>