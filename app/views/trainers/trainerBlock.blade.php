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
					
					<h3>{{$name}}</h3>
					<h5>{{$title}}</h5>
					<span>{{ HTML::image('/img/'.$gender.'.png', 'trainers gender')}}{{ $gender}}</span>
					<span><strong>{{$age}}</strong> years old </span>
					<span>member since {{$member_since}}</span>
					<div class="expand-wrapper" id="trainer-block-info-about">
						<p class="expand expand-short">{{  Str::limit($bio, 70)  }} <span>(read more)</span></p>
						<p class="expand expand-full">{{ $bio }} <span>(read less)</span></p>
					</div>
				</div>
			</div>
	@if(isset($orientation))
		</div>
	@endif
		

