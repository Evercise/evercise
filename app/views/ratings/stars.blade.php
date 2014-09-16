<?php
/** THIS WILL BE REMOVED I just need to get it running now!!! Iggy */

if(is_array($rating)) {
    $stars = 0;
    foreach ($rating as $r) {

        $stars += (is_object($r) ? $r->stars : $r['stars']);
    }
    $rating = count($rating) ? $stars / count($rating) : 0;
}
?>

@for ($i = 0; $i < 5; $i++)
	@if($i < floor($rating))
		{{ HTML::image('img/yellow_star.png', 'stars' , array('class' => 'star-icons')) }}
	@elseif($i < ceil($rating))
		{{ HTML::image('img/yellow_halfstar.png', 'stars' , array('class' => 'star-icons')) }}
	@else
		{{ HTML::image('img/yellow_emptystar.png', 'stars' , array('class' => 'star-icons')) }}
	@endif
@endfor