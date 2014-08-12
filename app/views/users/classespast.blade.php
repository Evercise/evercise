@if (empty($pastFutureCount) || $pastFutureCount['past'] == 0) 	
	<div class="dashboard-title">
		{{ HTML::image('img/cat-list.png', 'caegory list', array('class' => 'center cat-list-img')) }}
		<br>
		<br>
		<p>Here you will see all your upcoming classes, from here you will be able to message the trainer or if you can no longer attend the class you can leave (if you leave a class we will refund the value into your evercoin account, you can then use this to purchase other classes on evercise at a time that suits you).</p>
		<br>
		<br>
		<p><strong>You must leave a class more than 5 days in advanced to recieve the full amount in evercoins. Between 5 and 2 days you will receive 50% and any-less than 2 days you will not receive anything.</strong></p>
	</div>

	<div class="dashboard-body center">
	{{ HTML::image('img/search.png', 'caegory list', array('class' => 'center search-img')) }}
		<h5>You don&apos;t seem to have any attended classes,<br> you can search for new classes here.</h5>

		{{HTML::linkRoute('evercisegroups.search', 'Discover classes', null , ['class' => 'btn btn-yellow center mt10'])}}
	</div>
	
		
@else
	<div class="row9">
		@foreach ($sessions as $session)
			@if (new DateTime($session->date_time) < new DateTime() ) 
				<div id="classlist_{{$session->id}}" class="class-list-box">
					<div class="class-list-img-wrap">
						<a href="{{ URL::to('evercisegroups/'.$groups[$session->evercisegroup_id]->id) }}">
							{{ HTML::image('profiles/'.$groups[$session->evercisegroup_id]->user->directory .'/'. $groups[$session->evercisegroup_id]->image, 'class image', array('class' => 'class-list-img')) }}
						</a>
					</div>
					<div class="list-details">
						<h4>{{$groups[$session->evercisegroup_id]->name}}</h4>
						{{ HTML::image('img/clock_icon.png', 'date image', array('class' => 'block-icon mr10 float-left')) }} 
						<strong>{{ date('H:ia d-M-y', strtotime($session->date_time)) }}</strong>
					</div>
					<div class="list-rating">
						@if ( isset($ratings[$session->id]) )
							<div class="star_wrap">
								@include('ratings.stars', array('rating' => $ratings[$session->id]['stars'] ))
							</div>
							<p>Your Rating</p>
						@else
							
							<div class="list-staradd">
								<span data-rating="1" data-id="{{ $session->id }}" class="empty-star"></span>
								<span data-rating="2" data-id="{{ $session->id }}" class="empty-star"></span>
								<span data-rating="3" data-id="{{ $session->id }}" class="empty-star"></span>
								<span data-rating="4" data-id="{{ $session->id }}" class="empty-star"></span>
								<span data-rating="5" data-id="{{ $session->id }}" class="empty-star"></span>
							</div>
							<br>
							<br>
							<span>RATE CLASS</span>
							<br>
							<br>

							<br>
							<strong>Class not yet rated</strong>
						@endif
					</div>
					<div class="list-feedback">
						@if ( !isset($ratings[$session->id]) )
							<h6>Leave Feedback</h6>
							@if( (new DateTime($session->date_time)) > (new DateTime())->sub(new DateInterval('P5D')) && (new DateTime($session->date_time)) <= (new DateTime()))
								{{ HTML::link("/sessions/".$session->id."/refund", 'Problem with this class?', array('data-href' => "/sessions/".$session->id."/refund", 'class'=>'refund')) }}
							@endif
							{{ Form::open(array('id' => 'feedback', 'url' => 'ratings', 'method' => 'POST', 'class' => 'update-form')) }}
								{{ Form::hidden( 'session_id' , $session->id ) }}
								{{ Form::hidden( 'user_id' , $groups[$session->evercisegroup_id]->user_id ) }}
								{{ Form::hidden( 'evercisegroup_id' , $session->evercisegroup_id ) }}
								{{ Form::hidden( 'sessionmember_id' , $sessionmember_ids[$session->id] ) }}
								{{ Form::hidden( 'stars' , 0, array('id' => 'stars') ) }}


							@include('form.textarea', array('fieldname'=>'feedback_text', 'placeholder'=>'What did you think?', 'maxlength'=>400,  'fieldtext'=>'' ))
							@if ($errors->has('feedback_text'))
							    {{ $errors->first('feedback_text', '<p class="error-msg">:message</p>')}}
							@endif
							{{ Form::submit('Leave Feedback' , array('class'=>'btn btn-yellow disabled')) }}
						{{ Form::close() }}
						@else
							<h6>Your Feedback</h6>

							<div class="rating-block">
								<p>{{ $ratings[$session->id]['comment'] }}</p>
							</div>
						@endif

					</div>
				</div>
			@endif
		@endforeach
	</div>

@endif