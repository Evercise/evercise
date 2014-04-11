<!DOCTYPE html>
<html>
<head>
	<title>Master template</title>

	{{ stylesheet_link_tag() }}
	{{ javascript_include_tag() }}

</head>
<body>
	<div class="container">

		@yield('content')
		
	</div>
</body>
</html>