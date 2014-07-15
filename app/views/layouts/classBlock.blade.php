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
	<div id="block-body-wrap">
		@if(isset($venue))
			<div class="block-inner" id="block-venue">
				<div class="inner-float">
					{{ HTML::image('img/location_icon.png', 'date image', array('class' => 'block-icon')); }}
				</div>
				<div class="inner-float">
					<li>{{ $venue->name }}</li>
					<li>{{ $venue->address }}</li>
					<li>{{ $venue->town }}, {{ $venue->postcode }}</li>
				</div>
			</div>
		@endif
		@if(isset($default_size))
			<div class="block-inner" id="block-size">
				<div class="inner-float">
					{{ HTML::image('img/person_icon.png', 'date image', array('class' => 'block-icon')); }}
				</div>
				<div class="inner-float">
					<li>Class Size: {{ $default_size }}</li>
				</div>
			</div>
		@endif
	</div>
	
	@if(isset($default_price))
		<div class="block-footer">
			<span>Price</span>
			<strong>&pound;{{ $default_price }}</strong>
		</div>
	@endif
	
	
</div>