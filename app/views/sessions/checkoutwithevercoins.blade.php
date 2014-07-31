<div class='modal '>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head tc">
		<h4>Pay with Evercoins</h4>
	</div>

	<div class="modal-body">
		<div class="evercoins">
			<div class="evercoin-balance-wrap mr15">
				<div class="evercoin-balance-circle pounds">&pound;{{ $usecoinsInPounds}}</div>
				<div class="evercoin-balance-circle">{{ $priceInEvercoins }}e</div>
				
			</div>
			<p>Woohoo! You have enough Evercoins to pay for this class!</p>
			<p>Available Evercoins: {{ $evercoinBalance }}</p>
			<p>Basket Price in Evercoins: {{ $priceInEvercoins }}</p>
		</div>
		{{ Form::open(array('id' => 'paywithevercoins', 'url' => 'sessions/'.$evercisegroupId.'/paywithevercoins', 'method' => 'POST', 'class' => 'create-form')) }}

			{{ Form::hidden('usecoins', $priceInEvercoins, array('maxlength' => 10)) }}
			<div class="tc">
				{{ Form::submit('Pay with evercoins' , array('class'=>'btn-yellow mt10')) }}
			</div>
			

        	<div class="success_msg">Paid Successfully</div>

		{{ Form::close() }}
    </div>
</div>
