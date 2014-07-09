
<div>
	<p>{{ 'Evercoins: '. $evercoinBalance }}</p>
</div>

<br>
<br>

@if(!$fb)
	{{ HTML::linkRoute('tokens.fbtoken', 'get facebook', null , array('class' => 'btn-yellow')) }}
@else
	<p>facebook token got</p>
@endif

<br>
<br>

@if(!$tw)
	{{ HTML::linkRoute('twitter', 'get twitter', null , array('class' => 'btn-yellow')) }}
@else
	<p>twitter token got</p>
@endif

<br>
<br>

@if($profile < 100)
	<p>{{'Your profile is ' . $profile .'% complete' }}</p>
	{{ HTML::linkRoute('users.edit.tab', 'compete profile', [$id, 'profile'] , array('class' => 'btn-yellow')) }}
@else
	<p>Profile complete</p>
@endif

<br>
<br>
<p>{{'Referrals: '. $numReferrals .'/'.$totalReferrals }}</p>
<br>
<br>
<p>Pending invites</p>
@foreach($referrals as $r_key => $referral)
	@if( ! $referral->referee_id)
		<div>
			{{ $referral->email }}
		</div>
	@endif
@endforeach
<br>
<p>Accepted invites</p>
@foreach($referrals as $r_key => $referral)
	@if($referral->referee_id)
		<div>
			{{ $referral->email }}
		</div>
	@endif
@endforeach

<br>
<br>

{{ Form::open(array('id' => 'send_invite', 'url' => 'referrals', 'method' => 'POST', 'class' => 'create-form')) }}
	{{ Form::text( 'referee_email' , '', array('id' => 'referee_email')) }}
	{{ Form::submit('Send Invite' , array('class'=>'btn btn-yellow ')) }}
{{ Form::close() }}