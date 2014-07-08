<div class="cart-steps">
	<div class="cart-step" id="review">
		<div class="left">
			<h6>Evercoin Balance</h6>

		</div>
		<div class="right">
			<span class="evercoin-highlight">{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}} {{ $evercoins }}</span>
		</div>
	</div>
	<div class="cart-step">
		
		@foreach ($evercisegroup->evercisesession as $key => $session)
			<div class="left">
				<strong>1x {{ $evercisegroup->name}}</strong>
				<br>

				<p>{{  date('M-dS - H:ia' , strtotime($session->date_time)) }} </p>
			</div>
			<div class="right">
				<p>&pound;{{ $session->price }}</p>
			</div>
		@endforeach

		
	</div>

	<div class="cart-step">
		<div class="left">
			<p>Sub Total</p>
			<br>

			<p>Evercoins Used</p>
		</div>
		<div class="right">
			<p>&pound;{{ $totalPrice}}</p>
			<br>

			<p>{{ $deductEverciseCoins}}</p>
		</div>
	</div>
	<div class="cart-step">
		<div class="left">
			<h4>Total</h4>
		</div>
		<div class="right">	

			<h4>&pound;{{ $amountPaid }}</h4>
		</div>
	</div>

	
</div>