<div class="cart-steps">
	<div class="cart-step {{ $selected == 'review' ? 'selected' : null}}" id="review">
		<h6>1  -Review Order</h6>
	</div>
	<div class="cart-step {{ $selected == 'payment' ? 'selected' : null}}" id="payment">
		<h6>2 - Payment Details</h6>
		{{ HTML::image('img/lock.png', 'safe', ['class' => 'lock-icon'])}} 
		<br>
		{{ HTML::image('img/payment-excepted.png', 'safe', ['class' => 'payments-icon'])}} 
	</div>
	<div class="cart-step {{ $selected == 'complete' ? 'selected' : null}}" id="complete">
		<h6>3 - Order Complete</h6>
	</div>
</div>