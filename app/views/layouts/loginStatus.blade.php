
<div>
	User:
	{{{ isset($displayName) ? $displayName : "No Name Set" }}}
	{{ HTML::linkAction('UsersController@logout', 'Log Out') }}
</div>