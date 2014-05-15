<div class="class-block">
	<div class="class-block-img-wrap">
		{{ HTML::image($image, 'class image', array('class' => 'class-block-img')); }}
	</div>
	<h3>{{ $title }}</h3>
	@if($sessionDates)
		{{ Form::select( 'session_dates' , $sessionDates) }}
	@else
		<div class="class-block-no-dates"><p>No Upcoming Dates</p></div>
	@endif
	
	<div class="class-block-content">
		<p>{{ Str::limit($description, 115) }} </p>
	</div>
	
	<span>distance  &nbsp; &nbsp; <strong>{{ number_format($distance, 2, '.', '')}} miles</strong></span>
	<div class="class-block-stats">
		<div class="class-block-stat">
			<strong>0/22</strong>
			<span>class size</span>
		</div>
		<div class="class-block-stat">
			<div class="class-block-rating"></div>
			<span>rating</span>
		</div>
		<div class="class-block-stat">
			<strong>&pound;5.00</strong>
			<span>price</span>
		</div>
	</div>
</div>