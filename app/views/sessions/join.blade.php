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

				{{ Form::open(array('id' => 'join-sessions-stripe', 'url' => 'stripe/', 'method' => 'post', 'class' => '')) }}
					{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
					{{ Form::hidden( 'session-ids' , json_encode($sessionIds) , array('id' => 'session-ids', 'class' => 'session-ids')) }}
					<script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-amount="{{ $totalPrice }}" 
          data-image="/img/evercoin.png"
          data-name="Evercise"
          data-description="{{ $evercisegroup->name }}">
          </script>
          		{{ Form::close() }}
			</div>
		</div>
		{{--<div class="col3">
			@include('layouts.classBlock', array('evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$userTrainer->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
		</div>
		<div class="col9">
			<h1>{{$evercisegroup->name}}</h1>

			<hr>

			<div class="session-table">
				<li class="hd">Class Date</li>
				<li class="hd">Start Time</li>
				<li class="hd">End Time</li>
				<li class="hd">Price <small>(Per Person)</small></li>
				<li class="hd">No. Joined</li>
				<li class="hd">Cancel</li>
				<ul>
					@foreach ($evercisegroup->evercisesession as $key => $session)
						<div class="session-list-row">
							<li>{{ date('M-dS' , strtotime($session['date_time'])) }}</li>
							<li>{{ date('h:ia' , strtotime($session['date_time'])) }}</li>
							<li>{{ date('h:ia' , strtotime($session['date_time']) + ( $session['duration'] * 60))}}
							<li>&pound;{{ $session['price'] }}</li>
							<li> <strong>
							{{$members[$key] ? $members[$key] : 0}}
							</strong>/{{ $evercisegroup->capacity }} </li>
							<li><button data-price="{{ $session['price'] }}" data-session="{{$session->id}}" class="btn-cancel-session btn btn-red">Cancel</button></li>
						</div>
					@endforeach
				</ul>
				<div class="pay-with-evercoins">
					<span>Paid with Evercoins: <span id="pay-with-evercoins">0</span></span>
					<span> = &pound;<span id="pay-with-evercoins-in-pounds">0</span></span>
					<button data-href="/sessions/{{ $evercisegroup->id }}/paywithevercoins" class="btn-paywithevercoins btn btn-yellow">Pay with Evercoins</button>
				</div>
				<div class="session-total">
					{{ Form::open(array('id' => 'join-sessions', 'url' => 'payment/create', 'method' => 'get', 'class' => '')) }}
						<span>Total Sessions: <span id="total-sessions">{{ isset($totalSessions) ? $totalSessions : 0}}</span></span>
						<span>Total Price: &pound;<span id="total-price">{{ isset($totalPrice) ? $totalPrice : 0.00}}</span></span>
						<span>To Pay: &pound;<span id="to-pay">{{ isset($totalPrice) ? $totalPrice : 0.00}}</span></span>
						{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
						{{ Form::hidden( 'session-ids' , json_encode($sessionIds) , array('id' => 'session-ids')) }}
						{{ Form::submit('Pay Now' , array('class'=>'btn btn-green')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		--}}
		<div class="cart-right col4">
			@include('payments.step', ['selected' => 'review'])
		</div>

	</div>
@stop