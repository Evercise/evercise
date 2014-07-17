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
					@foreach ($evercisegroup->evercisesession as $key => $session)
						@include('payments.cartrows', ['evercisegroup_name' => $evercisegroup->name , 'date_time' => $session['date_time'] , 'sessionId' => $session->id , 'sessionIds' => $sessionIds, 'evercisegroup_id' =>$evercisegroup->id])
					@endforeach
				</ul>
			</div>
			@include('payments.paywithevercoins', ['evercisegroupId' => $evercisegroup->id])

			<div class="cart-total-block">
				<div class="left">
					<p>Sub Total:</p>
					<p>From your Evercoin balance:</p>
					<p><strong>Balance to pay:</strong></p>
				</div>
				<div class="right">
					<p>&pound; <span id="sub-total">{{ $totalPrice }}</span></p>
					<p><span id="evercoin-redeemed">0</span> <span class="evercoin">e</span></p>
					<p><strong>&pound;<span id="balance-to-pay">{{ $totalPrice }}</span></strong></p>
				</div>
				
			</div>
			<div class="cart-btn-wrap">
				{{ Form::open(array('id' => 'join-sessions', 'url' => 'payment/create', 'method' => 'get', 'class' => '')) }}
					{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
					{{ Form::hidden( 'session-ids' , json_encode($sessionIds) , array('id' => 'session-ids', 'class' => 'session-ids')) }}
					<button type="submit" class="btn">{{ HTML::image('img/paypal-express.png', 'evercoin', ['class' => 'evercoin-icon'])}}</button>
				{{ Form::close() }}
				<strong>- or -</strong>

				{{ Form::open(array('id' => 'join-sessions-stripe', 'url' => 'stripe/', 'method' => 'post', 'class' => '')) }}
					{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
					{{ Form::hidden( 'session-ids' , json_encode($sessionIds) , array('id' => 'session-ids', 'class' => 'session-ids')) }}
					
          		{{ Form::close() }}
			</div>
		</div>

		<div class="cart-right col4">
			@include('payments.step', ['selected' => 'review'])
		</div>

	</div>
@stop