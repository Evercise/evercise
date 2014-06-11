@extends('layouts.master')


@section('content')

<div  class="full-width">
	<div class="full-bk" style="background-image: url(/profiles/{{$userTrainer->directory}}/{{$evercisegroup->image}})">
	</div>
	<div id="class-trainer-wrapper" class="col3">

		@include('trainers.trainerBlock', array('orientation' => 'portrait', 'image' => '/profiles/'.  $userTrainer->directory.'/'. $userTrainer->image , 'name' => $userTrainer->display_name , 'member_since' => date('dS M-Y', strtotime( $userTrainer->created_at))))
	</div>
	<div class="col9">
		<ul class="class-nav">
			<li>Description</li>
			<li>Sessions</li>
			<li>Venues</li>
			<li>Reviews/Participants</li>
		</ul>
		<div class="class-wrap" id="description">
			<h1>{{ $evercisegroup->name }}</h1>
			<div class="share-wrap">
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->facebook()  }}"  class="btn">{{ HTML::image('img/fb-share.png','share on facebook', array('class' => 'share-btn')) }}</a>
				<a  class="btn">{{ HTML::image('img/tweeter-share.png','tweet', array('class' => 'share-btn')) }}</a>
				<a  class="btn">{{ HTML::image('img/google-share.png','share on google plus', array('class' => 'share-btn')) }}</a>
			</div>
			
			@include('evercisegroups.category_box', array('category' =>  $evercisegroup->category_id))
			<br>
			<p>{{ $evercisegroup->description }}</p>
						
		</div>
		<div class="class-wrap" id="sessions">
			<h4>Sessions</h4>
			<br>
			<div class="session-table">
				<li class="hd">Class Date</li>
				<li class="hd">Start Time</li>
				<li class="hd">End Time</li>
				<li class="hd">Price <small>(Per Person)</small></li>
				<li class="hd">No. Joined</li>
				<li class="hd">Join</li>
				<ul>
					@foreach ($evercisegroup->evercisesession as $key => $value)
							<div class="session-list-row">
								<li>{{ date('M-dS' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60))}}
								<li>&pound;{{ $value['price'] }}</li>
								<li> <strong>{{$members[$key]}}</strong>/{{ $evercisegroup->capacity }} </li>
								<li><button data-price="{{ $value['price'] }}" data-session="{{$value->id}}" class="btn-join-session btn btn-yellow">Join Session</button></li>
							</div>
					@endforeach
				</ul>
				<div class="session-total">
					{{ Form::open(array('id' => 'join-sessions', 'url' => 'sessions/join', 'method' => 'post', 'class' => '')) }}
						<span>Total Sessions: <span id="total-sessions">0</span></span>
						<span>Total Price: &pound;<span id="total-price">0.00</span></span>
						{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
						{{ Form::hidden( 'session-ids' , null, array('id' => 'session-ids')) }}
						{{ Form::submit('Checkout' , array('class'=>'btn btn-green')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		
	</div>
</div>

@stop