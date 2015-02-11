<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($title)? $title : 'Fitness Classes, Events & Gyms in London | Evercise'}}</title>
	<?php
	if (isset($metaDescription)) {
		$desc = $metaDescription;
	}
	?>
	<!-- Begin Inspectlet Embed Code -->
	<script type="text/javascript" id="inspectletjs">
		window.__insp = window.__insp || [];
		__insp.push(['wid', 362025054]);
		(function() {
			function __ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); }
			if (window.attachEvent){
				window.attachEvent('onload', __ldinsp);
			}else{
				window.addEventListener('load', __ldinsp, false);
			}
		})();
	</script>
	<!-- End Inspectlet Embed Code -->
	<meta name="description" content="{{ $desc or 'Evercise is an online platform that connects everyone wanting to exercise in a class with a wide array of Fitness Trainers and fitness classes all over London.'}}">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta charset="UTF-8">
	<meta name="language" content="en-UK"/>
	@if(isset($og))
	{{ $og->renderTags() }}
	@endif
	<meta name="msvalidate.01" content="029DC64552B69F2A7C8222158C81BB59"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="p:domain_verify" content="0b3c57d3323d503fbdced8d18b0c64d3"/>
	@if(isset($canonical))
	<link rel="canonical" href="{{ $canonical }}"/>
	@endif
	{{ HTML::style('assets/css/main.min.css?vs='.$version) }}
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
	<script type="text/javascript"
			src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
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
	{{ HTML::script('/assets/js/jquery.mobile.custom.min.js') }}
	{{ HTML::script('/assets/js/bootstrap-datepicker.js') }}
	{{ HTML::script('/assets/js/jquery.selectbox-0.2.min.js') }}
	{{ HTML::script('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}
	{{ HTML::script('/assets/js/cropper.min.js') }}

@if(isset($angular) )
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js') }}
	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js') }}
	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bluebird/1.2.2/bluebird.min.js') }}
	{{ HTML::script('/assets/js/angular-google-maps.min.js') }}
	{{ HTML::script('/assets/js/angular-device-detect.min.js') }}
@endif

	{{ HTML::script('/assets/js/main.min.js?vs='.$version) }}




	@yield('script')


	@include('v3.layouts.tracking')

</head>
<body {{ isset($angularApp) ? $angularApp : '' }}>

<!-- include app navigation  -->
{{ isset($header) ? $header : '' }}
<!-- include page body -->
@yield('body')
<!-- include footer -->
@if(isset($footer) && $footer != 'no' || !isset($footer))
	@include('v3.layouts.footer')
@endif
</body>