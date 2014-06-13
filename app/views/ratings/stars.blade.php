@for ($i = 0; $i < 5; $i++)
	@if($i < floor($rating))
		{{ HTML::image('img/yellow_star.png', 'stars' , array('class' => 'star-icons')) }}
	@elseif($i < ceil($rating))
		{{ HTML::image('img/yellow_halfstar.png', 'stars' , array('class' => 'star-icons')) }}
	@else
		{{ HTML::image('img/yellow_emptystar.png', 'stars' , array('class' => 'star-icons')) }}
	@endif
@endfor