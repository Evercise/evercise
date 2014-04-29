@if(isset($notification))
	<div class="notification-msg">{{ $notification }}</div>
@endif
@if ($notification = Session::get('notification'))
	<div class="notification-msg">{{ $notification }}</div>
@endif