<div class="row9">
		@foreach ($sessions as $session)
			<div class="class-list">
				<div class="class-date">
					<div class="day">{{ date('d', strtotime($session->date_time)) }}</div>
					<div class="month">{{ date('M', strtotime($session->date_time)) }}</div>
					<div class="year">{{ date('Y', strtotime($session->date_time)) }}</div>
				</div>
				<a href="{{ URL::to('evercisegroups/'.$groups[$session->evercisegroup_id]->id) }}">
					{{ HTML::image('profiles/'.$groups[$session->evercisegroup_id]->user->directory .'/'. $groups[$session->evercisegroup_id]->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$groups[$session->evercisegroup_id]->name}}</h4>
					<p>{{ Str::limit($groups[$session->evercisegroup_id]->description, 115) }}</p>	
				</div>
				<div class="list-info">
					<div class="list-row">
						<div class="half">
							<span>Distance</span>
						</div>
						<div class="half">
						</div>
					</div>
					<div class="list-row">
						<div class="half">
							<strong>
								@if(isset($members[$session->id]))
									{{ $members[$session->id] }}
								@else
								 	0
								@endif
								/{{ $groups[$session->evercisegroup_id]->capacity }}
							</strong>
							<br>
							<span>Class size</span>
						</div>
						<div class="half">
							<strong>&pound;{{ $session->price }}</strong>
							<br>
							<span>Price</span>
						</div>
					</div>

					<div class="list-row">
						<div class="half">
							
						</div>
						<div class="half">
							
						</div>
					</div>

					<span>Rating</span>
				</div>
				<div class="list-feedback">
					@if ( !isset($ratings[$session->id]) )
						<span>Leave Feedback</span>
						{{ Form::open(array('id' => 'feedback', 'url' => 'ratings', 'method' => 'POST', 'class' => 'create-form')) }}
							{{ Form::hidden( 'session_id' , $session->id ) }}
							{{ Form::hidden( 'user_id' , $groups[$session->evercisegroup_id]->user_id ) }}
							{{ Form::hidden( 'evercisegroup_id' , $session->evercisegroup_id ) }}
							{{ Form::hidden( 'sessionmember_id' , $sessionmember_ids[$session->id] ) }}
							{{ Form::hidden( 'stars' , 5 ) }}

							@include('form.textfield', array('fieldname'=>'feedback_text', 'placeholder'=>'What did you think?', 'maxlength'=>20, 'label'=>'Feedback', 'fieldtext'=>'' ))
							@if ($errors->has('feedback_text'))
							    {{ $errors->first('feedback_text', '<p class="error-msg">:message</p>')}}
							@endif
							{{ Form::submit('Save changes' , array('class'=>'btn-yellow ')) }}
						{{ Form::close() }}
					@else
						<span>{{ $ratings[$session->id] }}</span>
					@endif

				</div>
				
			</div>
			
		@endforeach
</div>