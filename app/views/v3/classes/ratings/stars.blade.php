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
		<span class="icon icon-full-star"></span>
	@elseif($i < ceil($rating))
		<span class="icon icon-empty-star"></span>
	@else
		<span class="icon icon-empty-star"></span>
	@endif
@endfor