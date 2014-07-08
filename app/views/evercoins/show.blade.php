
<div>
	{{ $evercoinBalance }}
</div>

@if(!$fb)
	{{ HTML::linkRoute('tokens.fbtoken', 'get facebook', null , array('class' => 'btn-yellow')) }}
@else
	<p>facebook token got</p>
@endif
@if(!$tw)
	{{ HTML::linkRoute('twitter', 'get twitter', null , array('class' => 'btn-yellow')) }}
@else
	<p>twitter token got</p>
@endif