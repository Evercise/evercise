<div class="row9">
	@foreach ($evercisegroups as $group_id => $group) 
		@foreach ($group->evercisesession as $session_id => $session) 
			<div class="class-list">
				<a href="{{ URL::to('evercisegroups/'.$group->id) }}">
					{{ HTML::image('profiles/'.$group->user->directory .'/'. $group->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$group->name}}</h4>
					<p>{{ Str::limit($group->description, 115) }}</p>	
				</div>
				<div class="list-info">
					<div class="list-row">
						<div class="half">
							<span>Distance</span>
						</div>
						<div class="half">
							<strong>{{-- number_format($miles[$group_id] , 2, '.', '') --}} miles</strong>
						</div>
					</div>
					<div class="list-row">
						<div class="half">
							<strong>
								@if(isset($members[$group_id]))
									{{ count($members[$group_id])}}
								@else
								 	0
								@endif
								/{{ $group->capacity }}
							</strong>
							<br>
							<span>Class size</span>
						</div>
						<div class="half">
							<strong>&pound;{{ $group->default_price }}</strong>
							<br>
							<span>Per person</span>
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
				
			</div>
			
		@endforeach
	@endforeach
</div>