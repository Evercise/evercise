
			<div class="class-list">
				<a href="{{ URL::to('evercisegroups/'.$evercisegroup->id) }}">
					{{ HTML::image('profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$evercisegroup->name}}</h4>
					<p>{{ Str::limit($evercisegroup->description, 115) }}</p>	
				</div>
				<div class="list-info">
					<div class="list-row">
						<div class="half">
							<span>Distance</span>
						</div>
						<div class="half">
							 <strong>{{ number_format($distance , 2, '.', '')}} miles</strong>
						</div>
					</div>
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
		