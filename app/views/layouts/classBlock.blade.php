<div class="class-block">
{{-- image ratio 2.35:1 / size 317*135 --}}
	<div class="class-block-img-wrap block-inner">
		<a href="{{ URL::to('evercisegroups/'.$evercisegroupId) }}">
			{{ HTML::image($image, 'class image', array('class' => 'class-block-img')); }}
		</a> 
	</div>

	
	<div class="class-block-header block-inner">
		@if(isset($title))
		    <a href="{{ URL::to('evercisegroups/'.$evercisegroupId) }}">
			    {{ Str::limit($title, 22) }}
			</a>
		@endif
		@if(isset($default_price))
			<p><strong class="highlight">&pound;{{ $default_price }}</strong><small>per person</small></p>
		@endif
	</div>
		
	
	
	<div class="class-block-body block-inner">
		@if(isset($sessions))
			{{ HTML::image('img/clock_icon.png', 'date image', array('class' => 'block-icon')); }}
			<div class="inner-float">
				<li class="bold">{{ date('d M Y - h:ia', strtotime($sessions[0]->date_time))}}</li>	
			</div>
			
		@endif
		
		<div class="venue-block">
			@if(isset($venue))
				{{ HTML::image('img/location_icon.png', 'date image', array('class' => 'block-icon')); }}
				<div class="inner-float">
					<li>{{ Str::limit($venue->name, 24) }}</li>
					<li>{{ Str::limit($venue->address, 24)  }}</li>
					<li>{{ Str::limit($venue->town, 18)   }}, {{ Str::limit($venue->postcode, 8) }}</li>
				</div>
			@endif
		</div>		
	</div>

</div>