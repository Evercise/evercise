<!DOCTYPE html>
<html>
<head>
	<title>Master template</title>
	{{ stylesheet_link_tag() }}
	{{ javascript_include_tag() }}
	<script type="text/javascript">
	     less.env = "development";
	     less.watch();
	</script>
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
</body>
</html>