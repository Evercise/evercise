<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Pay with Evercoins</h4>
		<br>
	</div>

	<div class="modal-body">
		<div class="evercoins">
			<p>Woohoo you have enough Evercoins to pay for this entire class!</p>
			<p>Available Evercoins: {{ $evercoinBalance }}</p>
			<p>Basket Price in Evercoins: {{ $priceInEvercoins }}</p>
		</div>
		{{ Form::open(array('id' => 'paywithevercoins', 'url' => 'sessions/'.$evercisegroupId.'/paywithevercoins', 'method' => 'POST', 'class' => 'create-form')) }}

			{{ Form::hidden('usecoins', $priceInEvercoins, array('maxlength' => 10)) }}
			{{ Form::submit('Pay with evercoins' , array('class'=>'btn-yellow ')) }}

        	<div class="success_msg">Paid Successfully</div>

		{{ Form::close() }}
    </div>
</div>
