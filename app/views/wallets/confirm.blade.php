<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Processing Withdrawal</h4>
	</div>

	<div class="modal-body modal-center">
		
		<p>Your withdrawal is currently being processed and should be complete within one working day.</p>

		<br>
		<p>Withdrawal amount: &pound;{{ $withdrawal }}</p>

		<br>
		<p>Paypal account: {{ $paypal }}</p>

				
			
	   
    </div>

     <div class="modal-footer modal-center">
     	{{ Form::submit('Close' , array('id'=>'close', 'class'=>'btn btn-yellow close')) }}
     </div>

</div>