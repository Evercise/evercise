
			<div class="class-list">
				<a href="{{ URL::to('evercisegroups/'.$evercisegroup->id) }}">
					{{ HTML::image('profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$evercisegroup->name}}</h4>
					<div class="inner-float">
						{{ HTML::image('img/person_icon.png', 'date image', array('class' => 'block-icon mr10')); }}
						<span>Class Size: {{ $evercisegroup->capacity}}</span>
					</div>
					@if(isset($evercisegroup->futuresessions))
						<div class="future-session-header mt10">
							{{ HTML::image('img/date_icon.png', 'date image', array('class' => 'block-icon mr10')); }}
							<span>{{ date('d M Y - h:ia', strtotime($evercisegroup->futuresessions[0]->date_time))}}</span>
						</div>
						
					@else
						<div class="block-spacer">
						</div>
						
					@endif

					@if(isset($evercisegroup->venue))
						<div class="block-inner mt10" id="block-venue">
							<div class="inner-float">
								{{ HTML::image('img/location_icon.png', 'date image', array('class' => 'block-icon mr10')); }}
								<span>{{ $evercisegroup->venue->address  }}</span><br>
								<span class="ml25"> &nbsp;{{ $evercisegroup->venue->town  }}, {{$evercisegroup->venue->postcode }}</span>
							</div>
						</div>
					@endif

				</div>
				<div class="list-info">

					<div class="list-row">
						<div class="half">
							<strong>
								@if(isset($members[$key]))
									{{ count($members[$key])}}
								@else
								 	0
								@endif
								/{{ $evercisegroup->capacity }}
							</strong>
							<br>
							<span>Class size</span>
						</div>
						<div class="half">
							<strong>&pound;{{ $evercisegroup->default_price }}</strong>
							<br>
							<span>Per person</span>
						</div>
					</div>

					<div class="list-row">
						@if (isset($rating)) 
							@include('ratings.stars', array('rating' => $rating))
						@endif
						<br>
						<span>Rating</span>

					</div>
					
				</div>
				
			</div>
		