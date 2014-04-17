<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Welcome</h2>

		<p><b>Account:</b> {{{ $display_name }}}</p>
		<p>To activate your account, <a href="{{ URL::to('users') }}/{{ $display_name }}/activate/{{ urlencode($activation_code) }}">click here.</a></p>
		<p>Or point your browser to this address: <br /> {{ URL::to('users') }}/{{ $display_name }}/activate/{{ urlencode($activation_code) }}</p>
		<p>Thank you, <br />
			~The Admin Team</p>
	</body>
</html>