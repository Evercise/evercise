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
			
			

			<div class="recommended-info">
				<div id="block-share" class="recommended-aside">
					<a href="{{ Share::load(URL::to('evercisegroups/'.$evercisegroup->id) , $evercisegroup->name)->facebook()  }}" target="_blank"  class="btn">{{ HTML::image('img/facebook.png','share on facebook', array('class' => 'share-icon')) }}</a>
					<a href="{{ Share::load(URL::to('evercisegroups/'.$evercisegroup->id) , $evercisegroup->name)->twitter()  }}" target="_blank" class="btn">{{ HTML::image('img/twitter.png','tweet', array('class' => 'share-icon')) }}</a>

				</div>
				<div class="recommended-aside">
				@include('ratings.stars', ['rating' => count($evercisegroup->ratings) == 0 ?  0 :  $ratings[$evercisegroup->id] / count($evercisegroup->ratings)])
				
				</div>

			</div>
			<div class=" block-footer">
				<span>Price</span>
				<strong>&pound;{{ $evercisegroup->default_price }}</strong>
			</div>
		</div>
	@endforeach	
</div>

