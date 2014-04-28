@if(isset($message))
	<div>{{ $message }}</div>
@endif
@if ($message = Session::get('message'))
	<div>{{ $message }}</div>
@endif