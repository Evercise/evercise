<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		font-family: 'Helvetica',sans-serif;
	}
	.container{
		border: 1px solid #ccc;
		border-top: none;
	}
	h1{
		font-size: 33px;
		text-align: center;
		color: #515151;
		font-weight: 400;
	}
	h3{
		font-size:22px;		
		text-align: center;
		color: #515151;
		font-weight: 400;
	}
	#banner{
		width: 100%;
		margin: -20px 0;
	}
	.pdf-table{
		border-top: 1px solid #ccc;
		margin: auto;
		width: 80%;
		padding: 40px 0;
	}
	.pdf-row{
		width: 100%;
		padding: 20px 0;
		margin: 0;
		float: left;
		clear: both;
		height: 60px;
		border-bottom: 1px dashed #ccc;
	}
	.session-list-profile{
		width: 60px;
		float: left;

		border: 2px solid #ccc;
	}
	.pdf-wrap{
		margin-left: 30px;
		margin-top: -15px;
		display: inline-block;
		float: left;
		font-weight: 200;

	}
</style>

</head>
<body>
	{{HTML::image('img/top_banner.jpg', 'Everybody exercise', array('width' => 600, 'id' => 'banner'));}}
	<div class="container">
		

		@yield('content')
	</div>
</body>
</html>