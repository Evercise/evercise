<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>


            h1 {font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 26px;  line-height: 30px; font-weight: 500; color:#768690; margin: 0}
            h3 {font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 18px;  line-height: 26px; font-weight: 500; color:#768690; margin: 0}
        	p { font-family: helvetica, arial, sans-serif; font-size: 14px;  line-height: 26px; font-weight: normal; color:#768690; }
        	b { font-weight: bold; color:#768690; }
        	.container{ padding: 30px}
        	.pink-text{ color: #ff1b7e}
        	.white-text{ color: #ffffff}
        	.image-left{ float: left; margin-right: 20px}
        	.image-right{ float: right; margin-left: 20px}
        	.footer { font-size: 12px; text-align: left;}
            .mb30{ width: 100%; margin-bottom: 30px; float: left;}


        	@media only screen and (max-device-width: 320px) and (max-device-height: 568px) {
                h1 { font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 30px; line-height: 42px; font-weight: 500; color:#768690; margin: 0 }
                p { font-family: helvetica, arial, sans-serif; font-size: 26px;  line-height: 38px; font-weight: normal; color:#768690; }
                b { font-weight: bold; color:#768690; }
                img { max-width: 640px; width: 100%}
                .footer { font-size: 13px; text-align: left;}
        	}

        	@media screen and (max-device-width: 375px) and (max-device-height: 667px) {
                h1 { font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 30px; line-height: 42px; font-weight: normal; color:#768690; }
                p { font-family: helvetica, arial, sans-serif; font-size: 26px;  line-height: 38px; font-weight: normal; color:#768690; }
                b { font-weight: bold; color:#768690; }
                img { max-width: 640px; width: 100%}
                .footer { font-size: 13px; text-align: left;}
        	}

        	</style>
    </head>
    <body width="100%" height="auto" bgcolor="#bfbfbf" style="margin:0; padding:0;">
    	<!-- Opening main -->
    	<table width="640" height="auto" bgcolor="#FFFFFF" border="0" align="center" cellspacing="0" cellpadding="0">
    		<tr>
    			<td>
                    <table width="640" height="auto" bgcolor="#FFFFFF" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <!-- Main image -->
                                <table width="640" height="auto" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <a href="#">
                                            {{ image('/assets/img/email/evercise-welcome.jpg') }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </tr>
                        </td>
                    </table>

                    <table width="640" height="auto" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                        <tr>
                            <td>
                                <!-- Messaging -->
                                <table width="640" height="20" align="left" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                                <table width="640" height="auto" align="center" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">

                                    <tr>
                                        <td align="center">
                                            <h1 class="pink-text">Welcome To Evercise</h1>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <p>Evercise is the exciting new <span class="pink-text">Pay As You Go</span> fitness community that’s flexible enough to fit in with your lifestyle and doesn&apos;t tie you down to an expensive gym membership.</p>
                                            <p>The Evercise network gives you access to a huge array of fun and flexible fitness classes wherever you are and our simple three-step process means it’s quick and easy to <span class="pink-text">sign up</span> and get involved.</p>

                                        </td>
                                    </tr>
                                </table>


                                <table width="640" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ff1b7e">
                                    <tr>
                                        <td>
                                            <div class="container">
                                                <div class="mb30">
                                                    <div class="image-left">
                                                        {{ image('/img/home/wie.png') }}
                                                    </div>
                                                    <h3 class="white-text">Search</h3>
                                                    <p class="white-text">Evercise makes it easy to search your area and discover the perfect class for you. With classes covering everything from aerobics to zumba you’re sure to find something nearby that takes your fancy.</p>
                                                </div>
                                                <div class="mb30">
                                                    <div class="image-right">
                                                        {{ image('/img/home/wie.png') }}
                                                    </div>

                                                    <h3 class="white-text">Select</h3>
                                                    <p class="white-text">You can see reviews of all our classes, find out more about the venue and facilities and ask the trainer any questions you might have. </p>
                                                </div>
                                                <div class="mb30">
                                                    <div class="image-left">
                                                        {{ image('/img/home/wie.png') }}
                                                    </div>
                                                    <h3 class="white-text">Sign up</h3>
                                                    <p class="white-text">When you’ve found a class you like the look of our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza! </p>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                </table>

                                <!-- Footer -->
                                <table width="640" height="85" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tr>
                                        <td width="30" height="85"></td>
                                        <td width="330" height="50">
                                            <p class="footer">&copy; Copyright 2014 Evercise</p>
                                            <a style="color:#50c3e2" href="%%unsuscride%%">Unsubscribe</a>
                                        </td>
                                        <td width="100" height="40">
                                           <p>Follow us on</p>
                                        </td>
                                        <td width="50" height="40" align="center">
                                            <a href="http://facebook.com/evercise"><img src="http://evercise.com/img/email-campaign/Facebook.png" width="40" height="40" border="0" alt="Facebook"></a>
                                        </td>
                                        <td width="50" height="40" align="center">
                                            <a href="http://twitter.com/evercise"><img src="http://evercise.com/img/email-campaign/Twitter.png" width="40" height="40" border="0" alt="Twitter"></a>
                                        </td>
                                        <td width="50" height="40" align="center">
                                            <a href="http://instagram.com/evercisefitness"><img src="http://evercise.com/img/email-campaign/Instagram.png" width="40" height="40" border="0" alt="Instagram"></a>
                                        </td>

                                        <td width="30" height="85"></td>
                                    </tr>
                                </table>

                            <!-- Closing main -->
                            </td>
                        </tr>
                    </table>
    			</td>
    		</tr>
    	</table>
    </body>
</html>

