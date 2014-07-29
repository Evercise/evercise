<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($title)? $title : 'Exercise for Everyone Everywhere'}}</title>
	<meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" /> 
    <meta name="viewport" content="width=device-width, user-scalable=no">
    @if(isset($og))
    	{{ $og->renderTags() }}
    @endif
	<link href='http://fonts.googleapis.com/css?family=Exo:300,400,500,600,300italic,400italic,500italic,600italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	<link href="/assets/application.css?version=2.1" rel="stylesheet" type="text/css">
	<script src="/assets/application.js?version=2.1"></script>

</head>
<body>
	@yield('banner')
	@if(isset($class))
		<div class="container no-bk">
	@else
		<div class="container">
	@endif
	

		@include('layouts.redirectmessage')
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
	</div>
	<div class="mask">

	</div>

	<script type="text/javascript">
	   var _mfq = _mfq || [];
	   (function() {
	       var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
	       mf.src = "//cdn.mouseflow.com/projects/c0202bf2-270c-42d5-9231-3d03589665ab.js";
	       document.getElementsByTagName("head")[0].appendChild(mf);
	   })();
	</script>
		
</body>
</html>