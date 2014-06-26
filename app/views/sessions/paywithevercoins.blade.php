<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Pay with Evercoins</h4>
		<br>
	</div>

	<div class="modal-body">
		<div class="evercoins">
			<p>Available Evercoins: {{ $evercoins }}</p>
			<p>Basket Price in Evercoins: {{ $priceInEvercoins }}</p>
		</div>
		{{ Form::open(array('id' => 'paywithevercoins', 'url' => 'sessions/'.$evercisegroupId.'/paywithevercoins', 'method' => 'POST', 'class' => 'create-form')) }}

			{{ Form::text('usecoins', 0, array('maxlength' => 4)) }}
			{{ Form::submit('Pay' , array('class'=>'btn-yellow ')) }}

        	<div class="success_msg">Paid Successfully</div>

		{{ Form::close() }}
    </div>
</div>