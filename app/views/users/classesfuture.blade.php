<div class="row9">
		@foreach ($sessions as $session)
		@if (new DateTime($session->date_time) > new DateTime() ) 
			<div  class="class-list-box">
				<div class="class-list-img-wrap">
					<a href="{{ URL::to('evercisegroups/'.$groups[$session->evercisegroup_id]->id) }}">
					{{ HTML::image('profiles/'.$groups[$session->evercisegroup_id]->user->directory .'/'. $groups[$session->evercisegroup_id]->image, 'class image', array('class' => 'class-list-img')) }}
					</a>	
				</div>
				
				<div class="list-details">
					<h4>{{$groups[$session->evercisegroup_id]->name}}</h4>
					<strong>{{ date('H:ia M-y', strtotime($session->date_time)) }}</strong>
					<p>{{ Str::limit($groups[$session->evercisegroup_id]->description, 115) }}</p>	
				</div>
				<div class="list-info">
				
					<div class="donut-chart">
							@if(isset($members[$session->id]))
								@include('widgets.donutChart', array('label' => 'Total Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings1','total' => $groups[$session->evercisegroup_id]->capacity, 'fill' => $members[$session->id] ))
							@else
							 	@include('widgets.donutChart', array('label' => 'Total Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings1','total' => 0 , 'fill' => 0))
							@endif
					</div>
							

					<div class="list-row">
						<strong>&pound;{{ $session->price }}</strong>
						<span>Price</span>
						<br>
						<span>Mail Trainer</span>
						{{ HTML::decode(HTML::linkRoute('sessions.mail_trainer', '<img src="/img/mail_icon.png"></img>', array('sessionId'=>$session->id, 'trainerId' => $groups[$session->evercisegroup_id]->user_id), array('class'=>'mail_trainer session-icon '))) }}
					</div>
				</div>
				
			</div>
		@endif
		@endforeach
</div>