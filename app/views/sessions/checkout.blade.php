@extends('layouts.master')


@section('content')
	<div  class="full-width">
		<div id="cart-list" class="col8">
			<div class="header-block">
				<h3>Step 1 - Review your order</h3>
			</div>
			<br>
			<br>
			<h6>Your Basket Items</h6>
			<br>
			<br>
			<div class="session-table">
				<li class="hd long">Item</li>
				<li class="hd">Quantity</li>
				<li class="hd">Price</li>
				<ul>
					@foreach ($data['cartRows'] as $key => $row)
						@include('payments.cartrows', ['evercisegroup_name' => $row->name , 'date_time' => $row->options->date_time , 'sessionId' => $row->options->sessionId , 'evercisegroup_id' =>$row->options->evercisegroupId])
					@endforeach
				</ul>
			</div>

			<div class="cart-total-block">
				<div class="left">
					<p>Sub Total:</p>
					<p>From your Evercoin balance:</p>
					<p><strong>Balance to pay:</strong></p>
				</div>
				<div class="right">
					<p>&pound; <span id="sub-total">{{ $data['total'] }}</span></p>
					<p><span id="evercoin-redeemed">0</span> <span class="evercoin">e</span></p>
					<p><strong>&pound;<span id="balance-to-pay">{{ $data['total'] }}</span></strong></p>
				</div>

			</div>
			<div class="cart-btn-wrap">
				{{ Form::open(array('id' => 'join-sessions', 'url' => 'payment/create', 'method' => 'get', 'class' => '')) }}
					<button type="submit" class="btn">{{ HTML::image('img/paypal-express.png', 'evercoin', ['class' => 'evercoin-icon'])}}</button>
				{{ Form::close() }}
				<strong>- or -</strong>

				{{ Form::open(array('id' => 'join-sessions-stripe', 'url' => 'stripe/', 'method' => 'post', 'class' => '')) }}
					<script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
			          data-key="@stripeKey"
			          data-image="{{url()}}/img/evercoin.png"
			          data-name="Evercise"
			          data-currency="gbp"
			          data-email="{{ $user->email}}"
			          data-address="true"
			          data-description="">
			          </script>
          		{{ Form::close() }}
			</div>
		</div>

		<div class="cart-right col4">
			@include('payments.step', ['selected' => 'review'])
		</div>

	</div>
@stop