
<div>
	User:
	@if(Session::has('username'))
		{{ $username }}
	@else
		None
	@endif
</div>