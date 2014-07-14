<div class="class-block">
{{-- image ratio 2.35:1 / size 317*135 --}}
	<div class="class-block-img-wrap block-inner">
		<a href="{{ URL::to('evercisegroups/'.$evercisegroupId) }}">
			{{ HTML::image($image, 'class image', array('class' => 'class-block-img')); }}
		</a> 
	</div>

	@if(isset($title))
		<div class="class-block-header block-inner">
			<h3>{{ $title }}</h3>
		</div>
		
	@endif
	<div class="block-inner class-block-body">
		@if (isset($rating)) 
			<div id="block-rating" class="inner-half">
				@include('ratings.stars', array('rating' => $rating))
			</div>
		@endif
		@if (isset($category))
			<div id="block-category" class="inner-half">
				{{ HTML::image('img/category/'.$category.'.png', 'category image', array('class' => 'category-icon')); }}
				<span>{{ Str::limit($category, 9) }}</span>
			</div> 
			
		@endif
	</div>
	@if(isset($sessions))
		<div class="future-session-header">
			{{ HTML::image('img/date_icon.png', 'date image', array('class' => 'block-icon')); }}
			<span>{{ date('d M Y - h:ia', strtotime($sessions[0]->date_time))}}</span>
		</div>
		<span id="more-sessions" class="btn">{{ HTML::image('img/down-arrow.png', 'show more sessions', array('class' => 'more-sessions')); }}</span>
		
		<ul class="future-session-list ">
			@foreach ($sessions as $key => $session)
				<li>{{ date('d M Y - h:ia', strtotime($session->date_time))}}</li>
			@endforeach
		</ul>
		

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
				<strong>{{$default_size}}</strong>
				<span>capacity</span>
			</div>
		@endif

		@if(isset($default_price))
			<div class="class-block-stat">
				<strong>&pound;{{ $default_price }}</strong>
				<span>price</span>
			</div>
		@endif
	</div>
</div>