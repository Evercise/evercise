<div class="row9">
	@foreach ($evercisegroups as $key => $value) 
			<div class="class-list">
				<a href="{{ URL::to('evercisegroups/'.$value->id) }}">
					{{ HTML::image('profiles/'.$value->user->directory .'/'. $value->image, 'class image', array('class' => 'class-list-img')) }}
				</a>
				<div class="list-details">
					<h4>{{$value->name}}</h4>
					<p>{{ Str::limit($value->description, 115) }}</p>	
				</div>
				<div class="list-info">
					<div class="list-row">
						<div class="half">
							<span>Distance</span>
						</div>
						<div class="half">
							<strong>{{ number_format($miles[$key] , 2, '.', '')}} miles</strong>
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
								/{{ $value->capacity }}
							</strong>
							<br>
							<span>Class size</span>
						</div>
						<div class="half">
							<strong>&pound;{{ $value->default_price }}</strong>
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
</div>