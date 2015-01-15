<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
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
                                            <h1 class="{{$style}}-text">{{ $title or "" }}</h1>
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

                                @if($banner)
                                    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                        <tr>
                                            <td>


                                                <a href="{{ URL::to($banner['url']) }}" title="{{ $banner['title'] }}">
                                                {{ image($banner['image'], $banner['title'] ) }}
                                                </a>


                                            </td>
                                        </tr>
                                    </table>
                                @endif

                                <!-- Footer -->
                                <table width="100%" height="85" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tr>
                                        <td class="sm-hidden" width="30"  height="85"></td>

                                        <td class="sm-hidden"  height="50">

                                            <p class="footer">&copy; Copyright 2015 Evercise</p>
                                            <p class="footer">&copy; First Floor, The Link</p>
                                            <p class="footer">&copy; 4 Wellesley Terrace, London</p>
                                            <p class="footer">&copy; N1 7NA</p>

                                        </td>
                                        <td width="100"  height="40" align="center">
                                            <p>Follow us on</p>
                                        </td>
                                        <td width="40"  height="40" align="center">
                                            <a href="http://facebook.com/evercise"><img src="http://evercise.com/img/email-campaign/facebook.png" width="40" height="40" border="0" alt="Facebook"></a>
                                        </td>
                                        <td width="40" height="40" align="center">
                                            <a href="http://twitter.com/evercise"><img src="http://evercise.com/img/email-campaign/twitter.png" width="40" height="40" border="0" alt="Twitter"></a>
                                        </td>
                                        <td width="40" height="40" align="center">
                                            <a href="http://instagram.com/evercisefitness"><img src="http://evercise.com/img/email-campaign/instagram.png" width="40" height="40" border="0" alt="Instagram"></a>
                                        </td>

                                        <td class="sm-hidden" width="30" height="85"></td>
                                    </tr>
                                </table>
                                <table width="100%" height="20" cellspacing="0" cellpadding="30" bgcolor="#ffffff">
                                    <tr>
                                        <td>
                                            {{ $unsubscribe }}
                                        </td>
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

