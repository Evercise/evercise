<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
	<meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" /> 
	<link href='http://fonts.googleapis.com/css?family=Exo:300,400,500,600,300italic,400italic,500italic,600italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	<link href="/assets/application.css?version=2.2" rel="stylesheet" type="text/css">
	<script src="/assets/application.js?version=2.2"></script>

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