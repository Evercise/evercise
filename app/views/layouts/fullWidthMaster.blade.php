<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" /> 
	<link href='http://fonts.googleapis.com/css?family=Exo:300,400,500,600,300italic,400italic,500italic,600italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	{{ stylesheet_link_tag() }}
	{{ javascript_include_tag() }}

</head>
<body class="full-width-body">	

		@include('layouts.redirectmessage')
		<section id="homepage-banner" class="banner">
			@include('layouts.header')
		
			@yield('top')
		</section>
		
		@yield('content')
		<div class="container-full">
		@include('layouts.footer')
		</div>
	</div>
	<div class="mask"></div>
</body>
</html>