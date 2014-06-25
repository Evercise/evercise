<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Email template</title>
	<style>
		@import url(http://fonts.googleapis.com/css?family=Lato);
		@import url(http://fonts.googleapis.com/css?family=Exo:400,700);
	</style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0"  style="table-layout:fixed; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; font-family: lato, Helvetica, ‘Helvetica Neue’, Arial; ">
<table width="100%" height="100%" cellpadding="0" style="padding:20px 0px 20px 0px table-layout:fixed;" bgcolor="#ebebeb">
	<tr align="center">
		<td> 
			<table width="600" height="135" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="color:#000000; padding: 0px 0px 0px 0px">
				<tr>
					<td valign="top">
						
						<!-- start Header -->
						<table width="600" height="135" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="color:#000000; padding: 0px 0px 0px 0px">
							<tr>
								<td>
									<a href="http://www.evercise.com" target="_blank" style="color: #336699;font-weight: normal;text-decoration: underline;">{{HTML::image('img/top_banner.jpg', 'Everybody exercise', array('width' => 600, 'id' => 'banner'));}}</a>
								</td>
							</tr>
						</table>
						<table width="600px" height="10px" cellpadding="0" cellspacing="0" bgcolor="#ffffff" >
							<tr>
								<td height="10" width="600"></td>
							</tr>
						</table>
						<!-- end header -->

						<!-- start heading -->
						<table width="600px" height="73px" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style=" font-size:18px; line-height:21.6px; color:#000000; padding: 0px 0px 0px 0px; font-family: Exo, lato, Helvetica, ‘Helvetica Neue’, Arial; ">
							<tr align="center">
								<td valign="top">
									<span style="font-size:24px; line-height:28.8px; font-weight:bold">So you want to Be a Pro?</span><br>
									<span>Your Professional User application is in the process of getting approved.</span>
									<br>
									<span>We aim to approve all professional accounts within 1 working day</span>
									<br>
									<span>You can still continue to us ethe site as a trainer and as soon as we are done proccesses your account your classes will become visable to our users</span>
								</td>
							</tr>
						</table>
						<!-- end heading -->

						<!-- start body -->
						<table width="600px" height="150" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style=" font-size:12px; line-height:14.4px; color:#000000; padding: 0px 40px 0px 40px; font-family: lato, Helvetica, ‘Helvetica Neue’, Arial; ">
							<tr align="left">
								<td valign="top" width="400">
									<span>Hi {{{ $display_name }}}.</span>
									<br>
									<br>
									<span>Thank you for your interest to become a Professional User on Evercise. You made a great choice! There are so many benefits of joining Evercise as a professional.</span>
									<br>
									<br>
									<span>Get started by adding classes today. </span>
									<br>
									<br>
									<span>Thanks for joining Evercise!</span>



									
								</td>
								<td valign="top" width="200" style="table-layout: fixed">
									{{HTML::image('img/WIE_4.jpg', 'lets get going', array('width' => 200, 'id' => 'potatoe'));}}

								</td>
							</tr>
						</table>
						<!-- end body -->


						<!-- start signature -->
						<table width="600" height="80" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style=" font-size:12px; line-height:14.4px; color:#000000; padding: 0px 40px 0px 40px; font-family: lato, Helvetica, ‘Helvetica Neue’, Arial; ">
							<tr align="left">
								<td valign="top">
									<span>Best,</span>
									<br>
									<span>The Evercise Team</span>
									<br>
									<a style="color:#0087D3" target="_blank" href="http://www.evercise.com">www.evercise.com</a>
								</td>
							</tr>
						</table>
						<!-- end signature -->

						<!-- start footer -->
						<table width="600" height="45" cellpadding="0" bgcolor="#180B0B" cellspacing="0" bgcolor="#ffffff" style=" font-size:10px; line-height:12px; color:#B1B1B1; padding: 3px 40px 0px 40px; font-family:lato, Helvetica, ‘Helvetica Neue’, Arial; ">
							<tr align="left">
								<td valign="top" width="355" style="padding: 10px 0px 0px 0px">
									<span>Need any help? Please <a style="color:#0087D3" href="http://www.evercise.com/contact.php">contact us</a></span>
								</td>
								<td valign="top" style="padding: 10px 5px 0px 0px;  color:#6A6A6A" >
									<span>follow us on</span> 
								</td>
								<td valign="top" >
									<a target="_blank" href="https://www.facebook.com/evercise" style="margin: 0px 5px 0px 0px">
					        		    {{HTML::image('img/facebook.png', 'facebook', array('id' => 'facebook'));}}
					       		 	</a>
					       		 	<a target="_blank" href="https://twitter.com/LetsEvercise"  style="margin: 0px 5px 0px 0px">
					        		    {{HTML::image('img/twitter.png', 'twitter', array('id' => 'twitter'));}}
					        		</a>
					        		<a target="_blank" href="https://google.com/+Evercisefitness">
					        		    {{HTML::image('img/googleplus.png', 'googleplus', array('id' => 'googleplus'));}}
					        		</a>
								</td>
							</tr>
							</table>
						<table width="600" height="25" cellpadding="0" bgcolor="#180B0B" cellspacing="0" bgcolor="#ffffff" style=" font-size:10px; line-height:12px; color:#6A6A6A; font-family:lato, Helvetica, ‘Helvetica Neue’, Arial; ">
							<tr align="center">
								<td valign="top">
									<span>Copyright © 2014 Qin Technology, All rights reserved.</span>
								</td>
							</tr>
						</table>

						<!-- end footer -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
</table>

</body>
</html>