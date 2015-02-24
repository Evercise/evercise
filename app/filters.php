<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    //
});


App::after(function ($request, $response) {
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (!Sentry::check()) {
        return Redirect::route('home');
    }
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});


Route::filter('admin', function () {
    if (!App::environment('local')) {

        // Find the user using the user id
        if ($user = Sentry::getUser()) {
            // Find the Administrator group
            $admin = Sentry::findGroupByName('Admin');

            // Check if the user is in the administrator group
            if (!$user->inGroup($admin)) {
                return Redirect::route('home')->with('notification',
                    'You do not have the correct privileges to view this page');
            }
        } else {
            return Redirect::route('home')->with('notification', 'You do not have the correct privileges to view this page');
        }
    }

});

Route::filter('user', function () {
    // Kick out if not logged in
    if (!Sentry::check()) {
        Session::flash('redirect_after_login_url', Request::url());
        return Redirect::route('auth.login');
        //return Redirect::route('home')->with('notification', 'You do not have the correct privileges to view this page. Please Log In');
    }
});

Route::filter('trainer', function () {
    // Kick out if not a trainer - send to trainer sign up page
    if (!Trainer::isTrainerLoggedIn()) {
        Session::flash('redirect_after_login_url', Request::url());
        return Redirect::route('auth.login');
        //return Redirect::route('trainers.create');
    }
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) {
        return Redirect::to('/');
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    $token = Input::header('X-CSRF-Token', Input::input('_token'));

    if (Session::token() !== $token) {
        throw new Illuminate\Session\TokenMismatchException;
    }

});


/* 404 handler */

App::missing(function ($exception) {
    //Since we have a fuckup here.. we need to do this one manually
    if (Request::is('trainer/*')) {
        return Redirect::to(str_replace('trainer/', 'trainers/', Request::url()), 301);
    }

    $redirects = Config::get('evercise.301_REDIRECTS');

    $current_url = ltrim($_SERVER['REQUEST_URI'], '/');

    if ($redirects) {
        foreach ($redirects as $url => $route) {
            if ($url == $current_url) {
                return Redirect::route($route, [], 301);
            }
        }
    }

    return Response::view('v3.errors.missing', ['title' => 'Whoops | 404 Page Not Found'], 404);
});

View::composer('*', function ($view) {
    // Share the name of the view, to be passed to the locatlisations (it's used to load the correct localisation file)
    View::share('view_name', $view->getName());

});