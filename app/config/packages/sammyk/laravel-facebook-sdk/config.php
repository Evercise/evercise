<?php

if (App::environment('local'))
{
return [

    /*
     * In order to integrate the Facebook SDK into your site,
     * you'll need to create an app on Facebook and enter the
     * app's ID and secret here.
     *
     * Add an app: https://developers.facebook.com/apps
     */
    'app_id' => ':492492450851682',
    'app_secret' => ':b5f9e533949178ebe7c33936c81ad833',

    /*
     * The default list of permissions that are
     * requested when authenticating a new user with your app.
     * The fewer, the better! Leaving this empty is the best.
     * You can overwrite this when creating the login link.
     *
     * Example:
     *
     * 'default_scope' => ['email', 'user_birthday'],
     *
     * For a full list of permissions see:
     *
     * https://developers.facebook.com/docs/facebook-login/permissions
     */
    'default_scope' => ['email','user_birthday','read_stream', 'publish_actions'],

    /*
     * The default endpoint that Facebook will redirect to after
     * an authentication attempt.
     */
    'default_redirect_uri' => '/tokens',

    /*
     * For a full list of locales supported by Facebook visit:
     *
     * https://www.facebook.com/translations/FacebookLocales.xml
     */
    'locale' => 'en_GB',

    /*
     * Allows you to customize the channel endpoint. Most
     * configurations won't need to change this but if you do,
     * and you're using the JavaScript SDK, make sure you also
     * update the "channelUrl" option in "FB.init()".
     *
     * https://developers.facebook.com/blog/post/2011/08/02/how-to--optimize-social-plugin-performance/
     */
    'channel_endpoint' => '/channel.html',

    ];
}
if (App::environment('staging')) // donkey
{
return [
    'app_id' => ':247621532113217',
    'app_secret' => ':762e0e54c435804033d7ece1d4b50122',

    'default_scope' => ['email','user_birthday','read_stream', 'publish_actions'],

    'default_redirect_uri' => '/facebook/login',

    'locale' => 'en_GB',
    
    'channel_endpoint' => '/channel.html',

    ];
}
if (App::environment('production')) // VS10319
{
return [
    'app_id' => ':425004847609443',
    'app_secret' => ':cef796862987836c8bb175e4304de6da',

    'default_scope' => ['email','user_birthday','read_stream', 'publish_actions'],

    'default_redirect_uri' => '/facebook/login',

    'locale' => 'en_GB',

    'channel_endpoint' => '/channel.html',

    ];
}