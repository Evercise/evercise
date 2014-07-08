@extends('layouts.master')


@section('content')
	<div  class="full-width">
		<div id="cart-list" class="col8">
			<div class="header-block">
				<h3>Step 3 - Order complete</h3>
			</div>
			<div class="header-block">
				<h6>Thank you - Your order has completed successfully</h6>
			</div>
			<div class="header-block">
				<p>This is to confirm that you have successfully purchased a place on the following class:
				</p>
				<p><strong>{{$evercisegroup->name}}</strong></p>
				<br>
				<p>We have sent you an e-mail to confirm your purchase. We will also send you a reminder e-mail the day before the class.</p>
				<br>
				<p>Your ref is: <strong>{{ $transactionId }}</strong></p>
			</div>

			<div class="pay-with-evercoins">
				<div class="evercoin-block" >
					{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}}
				</div>
				<div class="evercoin-wrap">
					<br>
					<p>Your new Evercoin balance is: <span class="evercoin-highlight">{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}} {{ $evercoins }} Evercoins</span></p>
				</div>

			</div>
			<hr>
			<div class="share-label">
				<p>Tell others what you&apos;re up to on Evercise</p>
			</div>
			
			<div class="share-wrap">
				<a href="{{ Share::load(URL::to('evercisegroups/'.$evercisegroup->id) , $evercisegroup->name)->facebook()  }}" target="_blank"  class="btn">{{ HTML::image('img/fb-share.png','share on facebook', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(URL::to('evercisegroups/'.$evercisegroup->id) , $evercisegroup->name)->twitter()  }}" target="_blank" class="btn">{{ HTML::image('img/tweeter-share.png','tweet', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(URL::to('evercisegroups/'.$evercisegroup->id) , $evercisegroup->name)->gplus()  }}" target="_blank" class="btn">{{ HTML::image('img/google-share.png','share on google plus', array('class' => 'share-btn')) }}</a>
			</div>

			



		</div>
		<div class="cart-right col4">
			@include('payments.step', ['selected' => 'complete'])
			@include('payments.cartOverview')
		</div>

	{{--
		<div class="col3">
			@include('layouts.classBlock', array('evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$userTrainer->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
				
		</div>
		<div class="col9">
			<h1>Thank you!</h1>
			<h5>This is to confirm that you have successfully purchased a place on the following class:<br>	
			{{$evercisegroup->name}} </h5>
			<br>
			<span>We have sent you an e-mail to confirm your purchase. We will also send you a reminder e-mail the day before the class.</span>

			<hr>
			<h5>Please find a break down below</h5>
			<br>

			<div class="session-table">
				<li class="hd">Class Date</li>
				<li class="hd">Start Time</li>
				<li class="hd">End Time</li>
				<li class="hd">Price <small>(Per Person)</small></li>
				<li class="hd">No. Joined</li>
				<li class="hd"></li>
				<ul>
					@foreach ($evercisegroup->evercisesession as $key => $value)
							<div class="session-list-row">
								<li>{{ date('M-dS' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60))}}
								<li>&pound;{{ $value['price'] }}</li>
								<li> <strong>
								{{$members[$key] ? $members[$key] : 0}}
								</strong>/{{ $evercisegroup->capacity }} </li>
								<li></li>
							</div>
					@endforeach
				</ul>
				<div class="session-total">
					{{ 'amount paid: '. $amountPaid. ', evercoins used: ' . $deductEverciseCoins }}
					{{ HTML::link('evercisegroups/'. $evercisegroup->id, 'class page' , ['class' => 'btn btn-yellow']); }}
					
				</div>
			</div>
		</div>
		
	--}}
	</div>
@stop