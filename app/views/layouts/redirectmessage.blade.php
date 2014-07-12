@if(isset($notification))
	<div class="notification-msg">{{ $notification }}</div>
@endif
@if ($notification = Session::get('notification'))
	<div class="notification-msg">{{ $notification }}</div>
@endif

@if(isset($errorNotification))
	<div class="notification-msg">{{ $errorNotification }}</div>
@endif
@if ($errorNotification = Session::get('errorNotification'))
	<div class="notification-msg-error">{{ $errorNotification }}</div>
@endif