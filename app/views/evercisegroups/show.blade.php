@extends('layouts.master')

<?php View::share('og', $og) ?>

@section('content')

<div  class="full-width">
	<div class="full-bk" style="background-image: url({{url()}}/profiles/{{$trainer->user->directory}}/{{$evercisegroup->image}})">
	</div>
	<div id="class-trainer-wrapper" class="col3">
		@include('trainers.trainerBlock', array('speciality' => $trainer->profession, 'id' =>  $trainer->user->id ,'orientation' => 'portrait', 'image' => '/profiles/'.  $trainer->user->directory.'/'. $trainer->user->image , 'name' => $trainer->user->display_name , 'member_since' => date('dS M-Y', strtotime( $trainer->user->created_at))))
	</div>
	<div class="col9">
		<ul class="class-nav sticky-header">
			<li><a href="#description">{{trans('evercisegroups-show.tab_description')}}</a></li>
			<li><a href="#sessions">{{Lang::choice('general.session', 2)}}</a></li>
			<li><a href="#venue">{{Lang::choice('general.venue', 2)}}</a></li>
			<li><a href="#reviews">{{trans('evercisegroups-show.tab_reviews')}}</a></li>
		</ul>
		<div class="class-wrap" id="description">
			<h1>{{ $evercisegroup->name }}</h1>
			<div class="share-wrap">
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->facebook()  }}" target="_blank"  class="btn">{{ HTML::image('img/fb-share.png','share on facebook', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->twitter()  }}" target="_blank" class="btn">{{ HTML::image('img/tweeter-share.png','tweet', array('class' => 'share-btn')) }}</a>
				<a href="{{ Share::load(Request::url() , $evercisegroup->name)->gplus()  }}" target="_blank" class="btn">{{ HTML::image('img/google-share.png','share on google plus', array('class' => 'share-btn')) }}</a>
			</div>
			
			<br>
			<p>{{ $evercisegroup->description }}</p>
			<br/>

			<p>{{Lang::choice('general.gender', 2)}}: 
				@if ($evercisegroup->gender == 0) All
				@elseif ($evercisegroup->gender == 1) Male
				@elseif ($evercisegroup->gender == 2) Female
				@endif
			</p>


			@if(count($evercisegroup->subcategories) > 0)
				@include('evercisegroups.category_box', ['subcategories' => $evercisegroup->subcategories])
			@endif	
		</div>
		<div class="class-wrap" id="sessions">
			<h4>{{Lang::choice('general.session', 2)}}</h4>
			<br>
			<div class="session-table">
				<li class="hd">{{trans('evercisegroups-show.sessions_head_1')}}</li>
				<li class="hd">{{trans('evercisegroups-show.sessions_head_2')}}</li>
				<li class="hd">{{trans('evercisegroups-show.sessions_head_3')}}</li>
				<li class="hd">{{trans('evercisegroups-show.sessions_head_4')}}</li>
				<li class="hd">{{trans('evercisegroups-show.sessions_head_5')}}</li>
				<li class="hd">{{trans('evercisegroups-show.sessions_head_6')}}</li>
				<ul>
					@foreach ($evercisegroup->futuresessions as $key => $futuresession)

							
							@if ($key < 3) 
								<div class="session-list-row">
							@else
								<div class="session-list-row extra hidden">
							@endif
									<li>{{ date('M-dS' , strtotime($futuresession->date_time)) }}</li>
									<li>{{ date('h:ia' , strtotime($futuresession->date_time)) }}</li>
									<li>{{ date('h:ia' , strtotime($futuresession->date_time) + ( $futuresession->duration * 60))}}
									<li>{{trans('general.currency_sign')}}{{ $futuresession->price }}</li>
									<li> <strong>{{ $evercisegroup->capacity -  $members[$futuresession->id] }}</strong></li>
									@if (isset($membersIds[$futuresession->id]))

										@if ($user ? (in_array($user->id, $membersIds[$futuresession->id]) ? true : false ) : false ) 

											<li><button  data-price="{{ $futuresession->price }}" data-session="{{$futuresession->id}}" class="btn-joined-session btn btn-blue disabled">Joined</button></li>
										@elseif ($members[$futuresession->id] >= $evercisegroup->capacity )
											<li><button  data-price="{{ $futuresession->price }}" data-session="{{$futuresession->id}}" class="btn-join-session btn-blue disabled">{{trans('evercisegroups-show.class_full')}}</button></li>

										@else
											<li><button  data-price="{{ $futuresession->price }}" data-session="{{$futuresession->id}}" class="btn-join-session btn btn-yellow">{{trans('evercisegroups-show.join_session')}}</button></li>
										@endif
									@else
											<li><button  data-price="{{ $futuresession->price }}" data-session="{{$futuresession->id}}" class="btn-join-session btn btn-yellow">{{trans('evercisegroups-show.join_session')}}</button></li>
										
									@endif

							@if ($key > 3) 
								</div>
							@else
								</div>
							@endif

							@if ($key >= 3 && $key == count($evercisegroup->futuresessions) - 1) 
								<div id="expand-sessions" class="session-list-row tc expand">
									<h5 class="extra">{{trans('evercisegroups-show.show_more')}}</h5>
									<h5 class="extra hidden">{{trans('evercisegroups-show.hide_more')}}</h5>
								</div>
							@endif
							
								
								
					@endforeach
				</ul>
				<div class="session-total">
					{{ Form::open(array('id' => 'join-sessions', 'url' => 'sessions/join', 'method' => 'post', 'class' => '')) }}
						<span>{{trans('evercisegroups-show.total_sessions')}}: <span id="total-sessions">0</span></span>
						<span>{{trans('evercisegroups-show.total_price')}}: {{trans('general.currency_sign')}}<span id="total-price">0.00</span></span>
						{{ Form::hidden( 'evercisegroup-id' , $evercisegroup->id, array('id' => 'evercisegroup-id')) }}
						{{ Form::hidden( 'session-ids' , null, array('id' => 'session-ids')) }}
						{{ Form::submit('Checkout' , array( 'id' => 'session-checkout','class'=>'btn btn-green disabled')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>


		<div class="class-wrap" id="venue">
			<div class="venue-details">
				<h4>{{Lang::choice('general.venue', 1)}}</h4>
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
			
			
			@if(count($venue->facilities) > 0)
				<ul class="facilities-wrap">
					<strong>{{trans('evercisegroups-show.venue_facilities')}}</strong>
					@foreach($venue->facilities as $key => $facility)
						@if ($facility->category == 'facility') 
							<li>{{ HTML::image('img/facility/'.$facility->image,'facilities icon', array('class' => 'facilities-icon')) }}{{ $facility->name}}</li>				
						@endif										
					@endforeach
				</ul>
			@endif

			
			@if(count($venue->facilities) > 0)
				<ul class="facilities-wrap">
					<strong>{{trans('evercisegroups-show.venue_amenities')}}</strong>
					@foreach($venue->facilities as $key => $facility)
						@if ($facility->category == 'Amenity') 
							<li>{{ HTML::image('img/facility/'.$facility->image,'facilities icon', array('class' => 'facilities-icon')) }}{{ $facility->name}}</li>				
						@endif										
					@endforeach
				</ul>	
			@endif
			
		</div>
		<div class="class-wrap" id="reviews"> 
			<h4>{{trans('evercisegroups-show.reviews_participants')}}</h4>
			<div class="tab-wrapper">
				<div class="tab-header">
					<button  data-view="review" id="review-btn" class="icon-btn btn selected">{{trans('general.reviews')}}</button>
					<button  data-view="participant" id="participant-btn" class="icon-btn btn">{{trans('general.participants')}}</button>
				</div>
				<div id="review" class="tab-view selected">
					<strong>{{trans('evercisegroups-show.overall_rating')}}</strong>
					<br>
					<br>
					<br>
					<div class="rating-wrap">



						@if($user ? $user->inGroup(Sentry::findGroupByName('Admin')) : false)
					    {{ Form::open(array('id' => 'fakerating_create', 'url' => 'admin/fakeratings', 'method' => 'post', 'class' => 'create-form')) }}

	        		@include('form.select', array('fieldname'=>'rator', 'label'=>'user', 'values'=>$fakeUsers))
	            @include('form.textfield', array('fieldname'=>'stars', 'placeholder'=>'stars', 'maxlength'=>10, 'label'=>'stars', 'default' => 5 ))
	            @include('form.textarea', array('fieldname'=>'comment', 'placeholder'=>'comment', 'maxlength'=>255, 'label'=>'comment', 'default' => '' ))
	            @include('form.hidden', array('fieldname'=>'evercisegroup_id', 'placeholder'=>'evercisegroup_id', 'maxlength'=>10, 'label'=>'evercisegroup_id', 'value' => $evercisegroup->id ))
	            
	            {{ Form::submit('Leave review' , array('class'=>'btn btn-yellow', 'id' => 'create_review')) }}

	            {{ Form::close() }}
            @endif


						
						@foreach ($allRatings as $rating) 
							<div class="rating-row">

								
								<div class="rating-block">
									{{ HTML::image('profiles/'.$rating['rator']['directory'].'/'.$rating['rator']['image'],  $rating['rator']['display_name']  , array('title' => $rating['rator']['display_name'] ,'class' => 'user-icon')) }}
									{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}


									<span>
									<div class="star_wrap">
										@for ($i = 0; $i < 5; $i++)
											{{ HTML::image('img/yellow_' . ($i < $rating['stars'] ? '' : 'empty') . 'star.png', 'stars' , array('class' => 'star-icons')) }}
										@endfor
									</div>
									


									<strong>  {{ $rating['rator']['display_name'] }}</strong> on {{ date('d/m/Y' , strtotime($rating['created_at']))}} </span>
									<p>{{ $rating['comment']}}</p> 
								</div>
							</div>

						@endforeach
					</div>
				</div>
				<div id="participant" class="tab-view">
					

					@foreach ($memberUsers as $memberUser)
						<div class="float-left participant-block">
							@if($memberUser['image'] != '')
								{{ HTML::image('profiles/'.$memberUser['directory'].'/'. $memberUser['image'], $memberUser['display_name'] , array('title' => $memberUser['display_name'] ,'class' => 'user-icon')) }}
								<span class="display_name">{{$memberUser['display_name']}}</span>
							@else
								{{ HTML::image('img/no-user-img.jpg', $memberUser['display_name'] , array('title' => $memberUser['display_name'] ,'class' => 'user-icon')) }}
								<span class="display_name">{{$memberUser['display_name']}}</span>
							@endif
						</div>
					@endforeach
				</div>
			</div>
		</div>
		
	</div>
</div>

@stop

