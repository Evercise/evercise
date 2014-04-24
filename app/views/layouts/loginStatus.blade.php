
<div style="color:white">
	User:
	{{{ isset($displayName) ? $displayName : "No Name Set" }}}
	{{ HTML::linkRoute('users.logout', 'Log Out') }}
</div>