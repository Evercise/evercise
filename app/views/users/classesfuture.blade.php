<div class="row9">
		@foreach ($sessions as $session)
		@if (new DateTime($session->date_time) > new DateTime() ) 
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
							<span>Mail Trainer</span>
						</div>
						<div class="half">
							{{ HTML::decode(HTML::linkRoute('sessions.mail_trainer', '<img src="/img/mail_icon.png"></img>', array('sessionId'=>$session->id, 'trainerId' => $groups[$session->evercisegroup_id]->user_id), array('class'=>'mail_trainer session-icon '))) }}
						</div>
					</div>
				</div>
				
			</div>
		@endif
		@endforeach
</div>