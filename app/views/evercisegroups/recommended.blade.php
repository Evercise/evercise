<div class="recommended-vertical-wrap">
	<h5>Recommended Classes</h5>
	@foreach( $evercisegroups as $key => $evercisegroup)
		<div class="recommended-block">
			<div class="block-header">
				<a href="{{ URL::to('evercisegroups/'.$evercisegroup->id) }}">
					{{ HTML::image('profiles/'.$evercisegroup->user->directory.'/'.$evercisegroup->user->image, 'class image', array('class' => 'recommended-block-img')); }}
				</a> 
				<h6>{{ Str::limit($evercisegroup->name, 14 )}}</h6>
			</div>
			
			<div class=" block-footer">
				<span>Price</span>
				<strong>&pound;{{ $evercisegroup->default_price }}</strong>
			</div>
		</div>
	@endforeach	
</div>

