@if(isset($orientation))
	@if($orientation == 'portrait')
		<div class="trainer-block-portrait-wrapper">
	@else
		<div class="trainer-block-landscape-wrapper">
	@endif
@endif
			<div class="trainer-block">
				<div class="trainer-block-image-wrapper">
					{{ HTML::image($image, 'trainers image', array('class'=> 'trainer-block-image'))}}
				</div>
				<div class="trainer-block-info-wrapper">
					
					<h4>{{$name}}</h4>
					<h5>{{$speciality}}</h5>
					<span class="rating">Rating</span>
					@if($orientation == 'portrait')
							<p>{{ Str::limit($bio, 120) }}</p>
					@else
						<div class="expand-wrapper" id="trainer-block-info-about">					
								<p class="expand expand-short">{{  Str::limit($bio, 70)  }} <span>(read more)</span></p>
								<p class="expand expand-full">{{ $bio }}
								 <span>(read less)</span></p>
						</div>
					@endif
				</div>
			</div>
	@if(isset($orientation))
		</div>
	@endif