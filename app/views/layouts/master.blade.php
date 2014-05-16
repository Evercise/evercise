<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	<link href='http://fonts.googleapis.com/css?family=Exo:300,400,500,600,300italic,400italic,500italic,600italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	{{ stylesheet_link_tag() }}
	{{ javascript_include_tag() }}

</head>
<body>
	<div class="container">

		@include('layouts.redirectmessage')
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
	</div>
	<div class="mask"></div>
</body>
</html>