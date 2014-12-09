<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>{{ $css }}</style>
    </head>
    <body  bgcolor="#bfbfbf">
    	<!-- Opening main -->
    	<table  bgcolor="#FFFFFF" border="0" align="center" cellspacing="0" cellpadding="0">
    		<tr>
    			<td>
                    <table width="100%" height="auto" bgcolor="#FFFFFF" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <!-- Main image -->
                                <table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <a href="{{ URL::to($link_url) }}" title="{{ $subject }}">
                                            {{ $image }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </tr>
                        </td>
                    </table>

                    <table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                        <tr>
                            <td>
                                <!-- Messaging -->
                                <table width="100%" height="20" align="left" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" height="auto" align="{{ $align or 'left' }}" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">
                                    @if($title)
                                    <tr>
                                        <td align="{{ $align or 'left' }}">
                                            <h1>{{ $title or "" }}</h1>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td align="{{ $align or 'left' }}">
                                            @yield('body')
                                        </td>
                                    </tr>
                                </table>

                                @yield('extra')

                                <?php if($banner) {
                                        $banner = $banner_types[$banner];
                                ?>
                                <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>


                                            <a href="{{ URL::to($banner['url']) }}" title="{{ $banner['title'] }}">
                                            {{ image($banner['image'], $banner['title'] ) }}
                                            </a>


                                        </td>
                                    </tr>
                                </table>
                                <?php } ?>

                                <!-- Footer -->
                                <table width="100%" height="85" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tr>
                                        <td width="30" height="85"></td>

                                        <td width="100" height="50">
                                            <a style="color:#50c3e2" href="{{ $unsubscribe }}">Unsubscribe</a>
                                        </td>
                                        <td width="230" height="50">
                                            <p class="footer">&copy; Copyright 2014 Evercise</p>
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

