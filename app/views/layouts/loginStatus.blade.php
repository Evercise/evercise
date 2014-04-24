@if($displayName != 'none')
	<li id="displayName" class="float-right">
		{{ $displayName }}
	</li>
	<div id="displayName-dropdown" class="dropdown-menu">
		<span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
	</div>
	
	
@else
	<li>{{ HTML::linkRoute('users.create', 'Join Evercise') }}</li>
	<li>{{ HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login')) }}</li>
@endif