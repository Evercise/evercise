
<div style="color:white">
	
	@if($displayName != 'none')
		User:
		{{ $displayName }}
		{{ HTML::linkRoute('users.logout', 'Log Out') }}
	@else
		{{ HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login')) }}
	@endif
</div>