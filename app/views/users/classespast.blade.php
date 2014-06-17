<div class="row9">
	@foreach ($sessions as $session)
		@if (new DateTime($session->date_time) < new DateTime() ) 
			<div class="class-list">
				<a href="{{ URL::to('evercisegroups/'.$groups[$session->evercisegroup_id]->id) }}">
					{{ HTML::image('profiles/'.$groups[$session->evercisegroup_id]->user->directory .'/'. $groups[$session->evercisegroup_id]->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$groups[$session->evercisegroup_id]->name}}</h4>
					<strong>{{ date('d', strtotime($session->date_time)) }}</strong>
					<p>{{ Str::limit($groups[$session->evercisegroup_id]->description, 115) }}</p>	
				</div>
				<div class="list-rating">
					@if ( isset($ratings[$session->id]) )
						<div class="star_wrap">
							@include('ratings.stars', array('rating' => $ratings[$session->id]['stars'] ))
						</div>
						<p>Your Rating</p>
					@else
						<strong>Class not yet rated</strong>
						<div class="list-staradd">
							<span data-rating="1" class="empty-star"></span>
							<span data-rating="2" class="empty-star"></span>
							<span data-rating="3" class="empty-star"></span>
							<span data-rating="4" class="empty-star"></span>
							<span data-rating="5" class="empty-star"></span>
						</div>
					@endif
				</div>
				<div class="list-feedback">
					@if ( !isset($ratings[$session->id]) )
						<h4>Leave Feedback</h4>
						{{ Form::open(array('id' => 'feedback', 'url' => 'ratings', 'method' => 'POST', 'class' => 'update-form')) }}
							{{ Form::hidden( 'session_id' , $session->id ) }}
							{{ Form::hidden( 'user_id' , $groups[$session->evercisegroup_id]->user_id ) }}
							{{ Form::hidden( 'evercisegroup_id' , $session->evercisegroup_id ) }}
							{{ Form::hidden( 'sessionmember_id' , $sessionmember_ids[$session->id] ) }}
							{{ Form::hidden( 'stars' , 5 ) }}


						@include('form.textfield', array('fieldname'=>'feedback_text', 'placeholder'=>'What did you think?', 'maxlength'=>20,  'fieldtext'=>'' ))
						@if ($errors->has('feedback_text'))
						    {{ $errors->first('feedback_text', '<p class="error-msg">:message</p>')}}
						@endif
						{{ Form::submit('Leave Feedback' , array('class'=>'btn btn-yellow ')) }}
					{{ Form::close() }}
				@else
					<span>Your Feedback</span>
					<div class="rating-wrap">
						<div class="rating-row">
							<div class="rating-block">
								{{ HTML::image('img/rating-arrow.png', 'ratng arrow place holder' , array('class' => 'rating-arrow-icon')) }}
								<p>{{ $ratings[$session->id]['comment'] }}</p>
							</div>
						</div>
					</div>
				@endif

				</div>
			</div>
		@endif
	@endforeach
</div>