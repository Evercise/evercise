<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Withdrawal Complete</h4>
		<br>
	</div>
	
	<div class="modal-body">
			<div class="col4">
				Withdrawal amount: {{ $withdrawal }}
		
			</div>
			<div class="col4">
				Paypal account: {{ $paypal }}
				
			</div>
			<div class="col3">
				<div class="grey-box">
				</div>
				{{ Form::submit('Close' , array('id'=>'close', 'class'=>'btn-yellow close')) }}
			</div>
				
    </div>

</div>