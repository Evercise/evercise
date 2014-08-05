@if(isset($orientation))
	@if($orientation == 'portrait')
		<div class="trainer-block-portrait-wrapper">
	@else
		<div class="trainer-block-landscape-wrapper">
	@endif
@endif
			<div class="trainer-block">
				<div class="trainer-block-image-wrapper">
					@if(isset($id))
						<a href="{{ URL::route('trainers.show', $id) }}" >{{ HTML::image($image, 'trainers image', array('class'=> 'trainer-block-image'))}}</a>
					@else
						{{ HTML::image($image, 'trainers image', array('class'=> 'trainer-block-image'))}}
					@endif
					
	
				</div>

				<div class="trainer-block-info-wrapper">
					
					<h4>
						{{$name}}
						@if(isset($orientation))
						@if($orientation == 'landscape')
							<span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
						@endif
					@endif
					</h4>
					<h5>{{$speciality}}</h5>
					@if(isset($trainerRating))
						<div class="rating">
							<span>Overall rating:</span>  
							<div class="star_wrap">
								@include('ratings.stars', array('rating' => $trainerRating ))
							</div>
						</div>
					@endif
					@if($orientation == 'portrait')
							<p>{{ Str::limit($bio, 120) }}</p>
					@else
						<div id="trainer-block-info-about">	
						{{--				
								<p class="expand expand-short">{{  Str::limit($bio, 70)  }} <span>(read more)</span></p>
								<p class="expand expand-full">{{ $bio }}
								 <span>(read less)</span></p>
						--}}
						<p> {{ $bio}}</p>
						</div>
					@endif
				</div>
			</div>
	@if(isset($orientation))
		</div>
	@endif
	