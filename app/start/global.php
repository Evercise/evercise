<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
    app_path().'/models',
    app_path().'/events',
    app_path().'/widgets',
    app_path().'/composers',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useDailyFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
    {
        Log::error('NotFoundHttpException Route: ' . Request::url() );
    }
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
    $ip = Request::getClientIp();

    $allowed = array('81.133.93.26', '127.0.0.1', '192.168.10.1');

    if(!in_array($ip, $allowed))
    {
        return Response::view('v3.errors.maintenance', array(), 503);
    }

});




require app_path().'/Functions.php';
/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


/*
|--------------------------------------------------------------------------
| Require The Composers File
|--------------------------------------------------------------------------
|
| Load a file containing the composers
|
*/

require app_path().'/composers.php';


/*
|--------------------------------------------------------------------------
| Require The observables File
|--------------------------------------------------------------------------
|
| Load a file containing the observables
|
*/

require app_path().'/observables.php';



/*
|--------------------------------------------------------------------------
| Require The cronjobs config File
|--------------------------------------------------------------------------
|
| Load a file containing the observables
|
*/

require app_path().'/start/cronjobs.php';




/*
|--------------------------------------------------------------------------
| Require The ShortCode Classes
|--------------------------------------------------------------------------
|
| Load a file containing the observables
|
*/

require app_path().'/shortcodes.php';