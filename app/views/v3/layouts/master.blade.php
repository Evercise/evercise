<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
	<meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" />
    @if(isset($og))
    	{{ $og->renderTags() }}
    @endif
    <meta name="msvalidate.01" content="029DC64552B69F2A7C8222158C81BB59" />
    <meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    {{ HTML::style('assets/css/main.css') }}
    <!-- load jquery -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery/jquery-2.1.1.min.js"></script>
    <!-- if jquery not loaded, load locally -->
    <script>window.jQuery || document.write('<script src="/assets/js/jquery-2.1.1.min.js">\x3C/script>')</script>
   <!-- load bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- check for boostrap otherwise load locally -->
    <script>
        var bootstrap3_enabled = (typeof $().emulateTransitionEnd == 'function');
        window.bootstrap3_enabled || document.write('<script src="/assets/js/bootstrap.min.js">\x3C/script>')
    </script>
    {{ HTML::script('/assets/js/main.min.js') }}

</head>
<body>
    <!-- include app navigation  -->
    @include('v3.layouts.navigation')
    <!-- include page body -->
    @yield('body')
    <!-- include footer -->
    @include('v3.layouts.footer')
</body>