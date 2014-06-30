@extends('layouts.master')


@section('content')

<div  class="full-width">
	<div class="full-bk" style="background-image: url(/profiles/{{$trainer->user->directory}}/{{$evercisegroup->image}})">
	</div>
	<div id="class-trainer-wrapper" class="col3">
		@include('trainers.trainerBlock', array('speciality' => $trainer->speciality->name.' '.$trainer->speciality->titles, 'id' =>  $trainer->user->id ,'orientation' => 'portrait', 'image' => '/profiles/'.  $trainer->user->directory.'/'. $trainer->user->image , 'name' => $trainer->user->display_name , 'member_since' => date('dS M-Y', strtotime( $trainer->user->created_at))))
	</div>
	<div class="col9">
		<ul class="class-nav sticky-header">
			<li><a href="#description">Description</a></li>
			<li><a href="#sessions">Sessions</a></li>
			<li><a href="#venue">Venues</a></li>
			<li><a href="#reviews">Reviews/Participants</a></li>
		</ul>
		<div class="class-wrap" id="description">
			<h1>{{ $evercisegroup->name }}</h1>
			<div class="share-wrap">
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->facebook()  }}"  class="btn">{{ HTML::image('img/fb-share.png','share on facebook', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->twitter()  }}" class="btn">{{ HTML::image('img/tweeter-share.png','tweet', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->gplus()  }}" class="btn">{{ HTML::image('img/google-share.png','share on google plus', array('class' => 'share-btn')) }}</a>
			</div>
			
			@include('evercisegroups.category_box', array('category' =>  $evercisegroup->category_id))
			<br>
			<p>{{ $evercisegroup->description }}</p>
			<br/>
			<p>Gender: 
				@if ($evercisegroup->gender == 0) Unisex
				@elseif ($evercisegroup->gender == 1) Male
				@elseif ($evercisegroup->gender == 2) Female
				@endif
			</p>
						
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
								@if (isset($membersIds[$key]))

									@if (empty($user->id))
										<li><button  data-price="{{ $value['price'] }}" data-session="{{$value->id}}" class="btn-joined-session btn btn-blue disabled">Login to join</button></li>
									@elseif (in_array($user->id, $membersIds[$key])) 

										<li><button  data-price="{{ $value['price'] }}" data-session="{{$value->id}}" class="btn-joined-session btn btn-blue disabled">Joined</button></li>
									@else
										<li><button  data-price="{{ $value['price'] }}" data-session="{{$value->id}}" class="btn-join-session btn btn-yellow">Join Session</button></li>
									@endif
								@else
									<li><button  data-price="{{ $value['price'] }}" data-session="{{$value->id}}" class="btn-join-session btn btn-yellow">Join Session</button></li>
								@endif
								
								
							</div>
					@endforeach
				</ul>
				<div class="session-total">
					{{ Form::open(array('id' => 'join-sessions', 'url' => 'sessions/join', 'method' => 'post', 'class' => '')) }}
						<span>Total Sessions: <span id="total-sessions">0</span></span>
						<span>Total Price: &pound;<span id="total-price">0.00</span></span>
						{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
						{{ Form::hidden( 'session-ids' , null, array('id' => 'session-ids')) }}
						{{ Form::submit('Checkout' , array( 'id' => 'session-checkout','class'=>'btn btn-green disabled')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<div class="class-wrap" id="venue">
			<div class="venue-details">
				<h4>Venue</h4>
				<br>
				<h5>{{$venue->name}}</h5>
				<br>
				<ul class="venue-address">
					<li>{{$venue->address}}</li>
					<li>{{$venue->town}}</li>
					<li>{{$venue->postcode}}</li>
				</ul>
			</div>
			<div class="class-map-wrap">
				@include('widgets.map', array('lat' =>$venue->lat, 'lng' =>  $venue->lng))
			</div>
			<hr>
			
			
			<ul class="facilities-wrap">
				<strong>Venue Facilities</strong>
				@foreach($venue->facilities as $key => $value)
					@if ($value->category == 'facility') 
						<li>{{ HTML::image('img/facility/'.$value->image,'facilities icon', array('class' => 'facilities-icon')) }}{{ $value->name}}</li>				
					@endif										
				@endforeach
			</ul>

			
			
			<ul class="facilities-wrap">
				<strong>Venue Amenities</strong>
				@foreach($venue->facilities as $key => $value)
					@if ($value->category == 'Amenity') 
						<li>{{ HTML::image('img/facility/'.$value->image,'facilities icon', array('class' => 'facilities-icon')) }}{{ $value->name}}</li>				
					@endif										
				@endforeach
			</ul>	
			
		</div>
		<div class="class-wrap" id="reviews"> 
			<h4>Reviews / Participants</h4>
			<div class="tab-wrapper">
				<div class="tab-header">
					<button  data-view="review" id="review-btn" class="icon-btn btn selected">Reviews</button>
					<button  data-view="participant" id="participant-btn" class="icon-btn btn">Participants</button>
				</div>
				<div id="review" class="tab-view selected">
					<strong>Overall Rating</strong>
					<br>
					<br>
					<br>
					<div class="rating-wrap">
						
						@foreach ($ratings as $key => $rating) 
							<div class="rating-row">

								
								<div class="rating-block">
									{{ HTML::image('profiles/'.$rating->user->directory.'/'.$rating->user->image,  $rating->user->display_name  , array('title' => $rating->user->display_name ,'class' => 'user-icon')) }}
									{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}


									<span>
									<div class="star_wrap">
										@for ($i = 0; $i < 5; $i++)
											{{ HTML::image('img/yellow_' . ($i < $rating->stars ? '' : 'empty') . 'star.png', 'stars' , array('class' => 'star-icons')) }}
										@endfor
									</div>
									


									<strong>  {{ $rating->user->display_name }}</strong> on {{ date('d/m/Y' , strtotime($rating->created_at))}} </span>
									<p>{{ $rating->comment}}</p> 
								</div>
							</div>

						@endforeach
					</div>
				</div>
				<div id="participant" class="tab-view">
					

					@foreach ($memberUsers as $key => $memberUser)
						@if($memberUser->image != '')
							{{ HTML::image('profiles/'.$memberUser->directory.'/'. $memberUser->image, $memberUser->display_name , array('title' => $memberUser->display_name ,'class' => 'user-icon')) }}
						@else
							{{ HTML::image('img/no-user-img.jpg', $memberUser->display_name , array('title' => $memberUser->display_name ,'class' => 'user-icon')) }}
						@endif
					@endforeach
				</div>
			</div>
		</div>
		
	</div>
</div>

@stop

