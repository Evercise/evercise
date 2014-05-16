<div class="class-block">
	<div class="class-block-img-wrap">
		{{ HTML::image($image, 'class image', array('class' => 'class-block-img')); }}
	</div>
	@if(isset($title))
		<h3>{{ $title }}</h3>
	@endif
	@if(isset($sessions))
		{{ Form::select( 'session_dates' , $sessions) }}

	@endif
	
	@if(isset($title))
		<div class="class-block-content">
			<p>{{ Str::limit($description, 115) }} </p>
		</div>
	@endif
	
	@if(isset($distance))
		<span>distance  &nbsp; &nbsp; <strong>{{ number_format($distance, 2, '.', '')}} miles</strong></span>
	@endif

	<div class="class-block-stats">
		@if(isset($participants))
			<div class="class-block-stat">
				<strong>{{ $participants}} /{{$default_size}}</strong>
				<span>class size</span>
			</div>
		@elseif(isset($default_size))
			<div class="class-block-stat">
				<strong>0 /{{$default_size}}</strong>
				<span>class size</span>
			</div>
		@endif
		<div class="class-block-stat">
			<div class="class-block-rating"></div>
			<span>rating</span>
		</div>
		@if(isset($default_price))
			<div class="class-block-stat">
				<strong>&pound;{{ $default_price }}</strong>
				<span>price</span>
			</div>
		@endif
	</div>
</div>