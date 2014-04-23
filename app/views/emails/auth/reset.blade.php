<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			Hi {{{ $displayName }}}, To reset your password:
			<a href="{{ URL::to('users') }}/{{ $displayName }}/resetpassword/{{ urlencode($resetCode) }}" target="_blank">click this link</a>
		</div>
	</body>
</html>