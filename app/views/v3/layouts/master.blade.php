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
    {{ HTML::style('assets/css/cropper.min.css') }}
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>

    <script>
        var BASE_URL = '{{ URL::to('/') }}';
        var AJAX_URL = '{{ URL::to('/ajax/') }}';
        var TOKEN = '{{ csrf_token() }}';
    </script>


    {{ HTML::script('/assets/js/holder.js') }}
    {{ HTML::script('/assets/js/bootstrap-datepicker.js') }}
    {{ HTML::script('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}
    {{ HTML::script('/assets/js/cropper.min.js') }}
    {{ HTML::script('/assets/js/main.min.js') }}


     @yield('script')

</head>
<body>
    <!-- include app navigation  -->
    {{ isset($header) ? $header : '' }}
    <!-- include page body -->
    @yield('body')
    <!-- include footer -->
    @if(isset($footer) && $footer != 'no' || !isset($footer))
        @include('v3.layouts.footer')
    @endif
</body>