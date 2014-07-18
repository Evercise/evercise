<div class="recommended-vertical-wrap">
	<h5>Recommended Classes</h5>
	@foreach( $evercisegroups as $key => $evercisegroup)
		@if (!in_array($evercisegroup->id, $testGroups))
			<div class="recommended-block">
				<div class="block-header">
					<a href="{{ URL::to('evercisegroups/'.$evercisegroup->id) }}">
						{{ HTML::image('profiles/'.$evercisegroup->user->directory.'/'.$evercisegroup->user->image, 'class image', array('class' => 'recommended-block-img')); }}
					</a> 
					<h6>{{ Str::limit($evercisegroup->name, 14 )}}</h6>
				</div>
				
				

				<div class="recommended-info">
					<div class="recommended-aside">
					@include('ratings.stars', ['rating' => count($evercisegroup->ratings) == 0 ?  0 :  $ratings[$evercisegroup->id] / count($evercisegroup->ratings)])
					
					</div>
					<div class="recommended-aside">
						{{ HTML::image('img/category/'.$evercisegroup->category->name.'.png', 'category image', array('class' => 'category-icon')); }}
						<span>{{ Str::limit($evercisegroup->category->name, 9) }}</span>
					</div>
				</div>
				<div class=" block-footer">
					<span>Price</span>
					<strong>&pound;{{ $evercisegroup->default_price }}</strong>
				</div>
			</div>
		@endif
	@endforeach	
</div>

