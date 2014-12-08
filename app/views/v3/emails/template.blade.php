<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>


            h3 {font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 18px; text-align: left; line-height: 30px; font-weight: 500; color:#768690; margin: 0}
        	p { font-family: helvetica, arial, sans-serif; font-size: 14px; text-align: left; line-height: 26px; font-weight: normal; color:#768690; }
        	b { font-weight: bold; color:#768690; }
        	.footer { font-size: 12px; text-align: left;}



        	@media only screen and (max-device-width: 320px) and (max-device-height: 568px) {
                h3 { font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 30px; text-align: left; line-height: 42px; font-weight: 500; color:#768690; margin: 0 }
                p { font-family: helvetica, arial, sans-serif; font-size: 26px; text-align: left; line-height: 38px; font-weight: normal; color:#768690; }
                b { font-weight: bold; color:#768690; }
                img { max-width: 640px; width: 100%}
                .footer { font-size: 13px; text-align: left;}
        	}

        	@media screen and (max-device-width: 375px) and (max-device-height: 667px) {
                h3 { font-family: helvetica, arial, sans-serif; text-transform: uppercase; font-size: 30px; text-align: left; line-height: 42px; font-weight: normal; color:#768690; }
                p { font-family: helvetica, arial, sans-serif; font-size: 26px; text-align: left; line-height: 38px; font-weight: normal; color:#768690; }
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
                                <table width="640" height="434" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            @yield('image')
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
                                <table width="640" height="auto" align="left" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                            @yield('title')
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            @yield('body')

                                        </td>
                                    </tr>
                                </table>


                                <table width="640" height="93" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                            @yield('upsell')
                                        </td>
                                    </tr>
                                </table>

                                <!-- Footer -->
                                <table width="640" height="85" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tr>
                                        <td width="30" height="85"></td>
                                        <td width="330" height="50">
                                            <p class="footer">&copy; Copyright 2014 Evercise</p>
                                            <a style="color:#50c3e2" href="{{ $unsubscribe }}">Unsubscribe</a>
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

