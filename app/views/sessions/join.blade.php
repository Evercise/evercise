@extends('layouts.master')


@section('content')
	<div  class="full-width">
		<div class="col3">
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
		

	</div>
@stop