<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
	<meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Evercise is an online platform that connects everyone wanting to exercise in a class with a wide array of Fitness Trainers and fitness classes all over London.'}}">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" />
    @if(isset($og))
    	{{ $og->renderTags() }}
    @endif
    <meta name="msvalidate.01" content="029DC64552B69F2A7C8222158C81BB59" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    {{ HTML::style('assets/css/main.min.css?vs='.$version) }}

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
    <script src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.5/masonry.pkgd.min.js"></script>
    <script>
        var masonry_enabled = (typeof $().masonry == 'function');
        window.masonry_enabled || document.write('<script src="/assets/js/masonry.min.js">\x3C/script>')
    </script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    <script>
        var bootsrap_validation_enabled = (typeof $().bootstrapValidator == 'function');
        window.bootsrap_validation_enabled || document.write('<script src="/assets/js/bootstrapValidator.min.js">\x3C/script>')
    </script>
    <script>
        var BASE_URL = '{{ URL::to('/') }}';
        var AJAX_URL = '{{ URL::to('/ajax/') }}';
        var TOKEN = '{{ csrf_token() }}';
    </script>

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bluebird/1.2.2/bluebird.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js') }}

    {{ HTML::script('/assets/js/angular-google-maps.min.js') }}

    {{ HTML::script('/assets/js/holder.js') }}
    {{ HTML::script('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}
    {{ HTML::script('/assets/js/main.min.js?vs='.$version) }}
    <!-- Latest compiled and minified JavaScript of jasny bootstrap -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

</head>
<body ng-app="DiscoverApp">
    <!-- include app navigation  -->
    {{ isset($header) ? $header : '' }}
    <!-- include page body -->
    @yield('body')
    <!-- include footer -->
    @if(isset($footer) && $footer != 'no' || !isset($footer))
        @include('v3.layouts.footer')
    @endif
    @include('layouts.laracasts')
</body>