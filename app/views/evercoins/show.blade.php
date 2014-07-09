
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

<br>
<br>

{{ Form::open(array('id' => 'send_invite', 'url' => 'referrals', 'method' => 'POST', 'class' => 'create-form')) }}
	{{ Form::text( 'referee_email' , '', array('id' => 'referee_email')) }}
	{{ Form::submit('Send Invite' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}