<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//

// temporary routes for new layouts


Route::get('/popular', ['as' => 'popular',  function()
    {
        return View::make('v3.home');
    }]
);
Route::get('/profile', ['as' => 'profile',  function()
    {
        return View::make('v3.users.profile.master');
    }]
);
Route::get('/class', ['as' => 'class',  function()
    {
        return View::make('v3.classes.class_page');
    }]
);
Route::get('/discover', ['as' => 'discover',  function()
    {
        return View::make('v3.classes.discover.master');
    }]
);
Route::get('/discover-list', ['as' => 'discover_list',  function()
    {
        return View::make('v3.classes.discover.master-list');
    }]
);
Route::get('/discover-grid', ['as' => 'discover_grid',  function()
    {
        return View::make('v3.classes.discover.master-grid');
    }]
);
Route::get('/register-trainer', ['as' => 'register_trainer',  function()
    {
        return View::make('v3.trainers.create');
    }]
);
Route::get('/finished-trainer', ['as' => 'finished_trainer',  function()
    {
        return View::make('v3.trainers.complete');
    }]
);

Route::get('/create-class', ['as' => 'create-class',  function()
    {
        return View::make('v3.classes.create');
    }]
);
Route::get('/class-add-sessions', ['as' => 'class-add-sessions',  function()
    {
        return View::make('v3.classes.add_sessions');
    }]
);


/* end tempary routes for new styles */


/* Freking wrong url on page */
Route::get(
    'what_is_evercise',
    function () {
        return Redirect::to('about');
    }
);

// ajax prefix
Route::group( [ 'prefix' => 'ajax' ], function()
{
    Route::post('/users-store', array('as' => 'users.store', 'uses' => 'ajax\UsersController@store'));
});

/* Show home page */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));

// auth / login

Route::get(
    'auth/login/{redirect_after_login_url}',
    array(
        'as' => 'auth.login.redirect_after_login',
        function ($redirect_after_login_url) {
            return View::make('auth.login')->with('redirect_after_login', true)->with(
                'redirect_after_login_url',
                $redirect_after_login_url
            );
        }
    )
);
Route::get(
    'auth/login',
    array(
        'as' => 'auth.login',
        function () {
            return View::make('auth.login')->with('redirect_after_login', false)->with(
                'redirect_after_login_url',
                false
            );
        }
    )
);




Route::get('login/fb/{redirect?}', array('as' => 'users.fb', 'uses' => 'UsersController@fb_login'));
Route::post('auth/checkout', array('as' => 'auth.checkout', 'uses' => 'SessionsController@checkout'));

Route::post('auth/login', array('as' => 'auth.login.post', 'uses' => 'auth\AuthController@postLogin'));
Route::get('auth/logout', array('as' => 'auth.logout', 'uses' => 'auth\AuthController@getLogout'));
Route::get('auth/forgot', array('as' => 'auth.forgot', 'uses' => 'auth\AuthController@getForgot'));
Route::post('auth/forgot', array('as' => 'auth.forgot.post', 'uses' => 'auth\AuthController@postForgot'));

//  Users
Route::get('/register', array('as' => 'register', 'uses' => 'UsersController@create'));
Route::get('/finished-user', ['as' => 'finished.user.registration',  function()
    {
        new BaseController();
        return View::make('v3.users.complete');
    }]
);

Route::get('users/{id}/edit/{tab?}', array('as' => 'users.edit', 'uses' => 'UsersController@edit'));
Route::get(
    '/users/{display_name}/activate/{code}',
    array('as' => 'users.activate', 'uses' => 'UsersController@activate')
);
Route::get(
    '/users/{display_name}/activate',
    array('as' => 'users.activatecodeless', 'uses' => 'UsersController@pleaseActivate')
);
Route::get(
    '/users/{display_name}/resetpassword/{code}',
    array('as' => 'users.resetpassword', 'uses' => 'UsersController@getResetPassword')
);
Route::post(
    '/users/resetpassword',
    array('as' => 'users.resetpassword.post', 'uses' => 'UsersController@postResetPassword')
);
Route::get(
    '/users/{display_name}/changepassword',
    array('as' => 'users.changepassword', 'uses' => 'UsersController@getChangePassword')
);
Route::post(
    '/users/changepassword',
    array('as' => 'users.changepassword.post', 'uses' => 'UsersController@postChangePassword')
);
Route::get('/users/{display_name}/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

// trainers
Route::get(
    'trainers/trainer/signup',
    array('as' => 'trainers.trainerSignup', 'uses' => 'TrainersController@trainerSignup')
);
Route::get('trainers/create', array('as' => 'trainers.create', 'uses' => 'TrainersController@create'));
Route::get('trainers/{id}/edit', array('as' => 'trainers.edit', 'uses' => 'TrainersController@edit'));
Route::get('trainers/{id}', array('as' => 'trainers.show', 'uses' => 'TrainersController@show'));
Route::get('trainers/{id}/edit/{tab}', array('as' => 'trainers.edit.tab', 'uses' => 'TrainersController@edit'));
Route::post('trainers/store', array('as' => 'trainers.store', 'uses' => 'TrainersController@store'));
Route::put('trainers/update/{id}', array('as' => 'trainers.update', 'uses' => 'TrainersController@update'));

// evercisegroups (classes)
Route::get(
    'evercisegroups',
    ['as' => 'evercisegroups.index', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@index']
);
Route::get(
    'evercisegroups/create',
    ['as' => 'evercisegroups.create', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@create']
);
Route::post(
    'evercisegroups',
    ['as' => 'evercisegroups.store', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@store']
);
Route::get('/evercisegroups/{id}', array('as' => 'evercisegroups.show', 'uses' => 'EvercisegroupsController@show'));
Route::delete(
    '/evercisegroups/{id}',
    array('as' => 'evercisegroups.destroy', 'uses' => 'EvercisegroupsController@destroy')
);

Route::get(
    '/evercisegroups/clone_evercisegroups/{id}',
    array('as' => 'evercisegroups.clone_evercisegroups', 'uses' => 'EvercisegroupsController@cloneEG')
);
Route::post(
    '/evercisegroups/delete/{id}',
    array('as' => 'evercisegroups.delete', 'uses' => 'EvercisegroupsController@deleteEG')
);


//NEW STATIC PAGES

// layouts and static pages
Route::get('uk/about', array('as' => 'static.about', 'uses' => 'StaticController@show'));
Route::get('uk/terms_of_use', array('as' => 'static.terms_of_use', 'uses' => 'StaticController@show'));
Route::get('uk/privacy', array('as' => 'static.privacy', 'uses' => 'StaticController@show'));
Route::get('uk/the_team', array('as' => 'static.the_team', 'uses' => 'StaticController@show'));
Route::get('uk/faq', array('as' => 'static.faq', 'uses' => 'StaticController@show'));
Route::get('uk/class_guidelines', array('as' => 'static.class_guidelines', 'uses' => 'StaticController@show'));
Route::get('uk/contact_us', array('as' => 'static.contact_us', 'uses' => 'StaticController@show'));
Route::get('uk/how_it_works', array('as' => 'static.how_it_works', 'uses' => 'StaticController@show'));

//Redirect All UK segments to the same function and we will go from there
Route::any('/uk/{allsegments}', array('as' => 'search.parse', 'uses' => 'SearchController@parseUrl'))->where(
    'allsegments',
    '(.*)?'
);
Route::any('/uk/', array('as' => 'evercisegroups.search', 'uses' => 'SearchController@parseUrl'));


// VenuesController
Route::get('venues', 'VenuesController@index');
Route::get('venues/create', 'VenuesController@create');
Route::get('venues/edit/{id}', 'VenuesController@edit');
Route::post('venues/store', ['as' => 'venue.store', 'uses' => 'VenuesController@store']);
Route::post('venues/update/{id}', 'VenuesController@update');


// sessions
Route::get(
    'sessions/{evercisegroup_id}/index',
    array('as' => 'evercisegroups.trainer_show', 'uses' => 'SessionsController@index')
);
Route::get('sessions/date_list', array('as' => 'sessions.date_list'));
Route::post('sessions/join', array('as' => 'sessions.join', 'uses' => 'SessionsController@joinSessions'));
Route::get('sessions/join/class', array('as' => 'sessions.join.get', 'uses' => 'SessionsController@joinSessions'));
Route::get(
    'sessions/{evercisegroupId}/pay',
    array('as' => 'sessions.pay', 'uses' => 'SessionsController@payForSessions')
);
Route::get('/sessions/{id}', array('as' => 'sessions.show', 'uses' => 'SessionsController@show'));
Route::get(
    '/sessions/{sessionId}/leave',
    array('as' => 'sessions.leave', 'uses' => 'SessionsController@getLeaveSession')
);
Route::post(
    '/sessions/{sessionId}/leave',
    array('as' => 'sessions.leave.post', 'uses' => 'SessionsController@postLeaveSession')
);

// payment
Route::get(
    'sessions/{evercisegroupId}/paywithstripe',
    array('as' => 'sessions.pay.stripe', 'uses' => 'SessionsController@payForSessionsStripe')
);
Route::get('stripetestpay', array('as' => 'pay.stripe', 'uses' => 'StripePaymentController@pay'));
Route::get('stripetest', array('as' => 'paid.stripe', 'uses' => 'StripePaymentController@paid'));
Route::post(
    'wallets/{userId}/update_paypal',
    array('as' => 'wallets.updatepaypal', 'uses' => 'WalletsController@updatePaypal')
);
Route::post(
    '/sessions/{evercisegroupId}/redeemEvercoins',
    array('as' => 'sessions.redeemEvercoins.post', 'uses' => 'SessionsController@redeemEvercoins')
);
Route::get(
    '/sessions/{evercisegroupId}/paywithevercoins',
    function ($evercisegroupId) {
        return Redirect::to('evercisegroups/' . $evercisegroupId);
    }
);
Route::post(
    '/sessions/{evercisegroupId}/paywithevercoins',
    array('as' => 'sessions.paywithevercoins.post', 'uses' => 'SessionsController@postPayWithEvercoins')
);
Route::get('/sessions/{sessionId}/refund', array('as' => 'sessions.refund', 'uses' => 'SessionsController@getRefund'));
Route::post(
    '/sessions/{sessionId}/refund',
    array('as' => 'sessions.refund.post', 'uses' => 'SessionsController@postRefund')
);

// mail
Route::get('/sessions/{id}/mail_all', array('as' => 'sessions.mail_all', 'uses' => 'SessionsController@getMailAll'));
Route::post(
    '/sessions/{id}/mail_all',
    array('as' => 'sessions.mail_all.post', 'uses' => 'SessionsController@postMailAll')
);
Route::get(
    '/sessions/{sessionId}/mail_one/{userId}',
    array('as' => 'sessions.mail_one', 'uses' => 'SessionsController@getMailOne')
);
Route::post(
    '/sessions/{sessionId}/mail_one/{userId}',
    array('as' => 'sessions.mail_one.post', 'uses' => 'SessionsController@postMailOne')
);
Route::get(
    '/sessions/{sessionId}/mail_trainer/{trainerId}',
    array('as' => 'sessions.mail_trainer', 'uses' => 'SessionsController@getMailTrainer')
);
Route::post(
    '/sessions/{sessionId}/mail_trainer/{trainerId}',
    array('as' => 'sessions.mail_trainer.post', 'uses' => 'SessionsController@postMailTrainer')
);

// widgets
Route::get('/widgets/upload', array('as' => 'widgets.upload', 'uses' => 'widgets\ImageController@getUploadForm'));
Route::post('/widgets/upload', array('as' => 'widgets.upload.post', 'uses' => 'widgets\ImageController@postUpload'));
Route::get('/widgets/crop', array('as' => 'widgets.crop', 'uses' => 'widgets\ImageController@getCrop'));
Route::post('/widgets/crop', array('as' => 'widgets.crop.post', 'uses' => 'widgets\ImageController@postCrop'));
Route::get('/widgets/map', array('as' => 'widgets.map', 'uses' => 'widgets\LocationController@getMap'));
Route::get('/widgets/mapForm', array('as' => 'widgets.map-form', 'uses' => 'widgets\LocationController@getGeo'));
Route::post('/widgets/postGeo', array('as' => 'widgets.postGeo', 'uses' => 'widgets\LocationController@postGeo'));
Route::get('/widgets/calendar', array('as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@getCalendar'));
Route::post(
    '/widgets/calendar',
    array('as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@postCalendar')
);

// layouts and static pages
Route::get('about', array('as' => 'static.about', 'uses' => 'StaticController@show'));
Route::get('terms_of_use', array('as' => 'static.terms_of_use', 'uses' => 'StaticController@show'));
Route::get('privacy', array('as' => 'static.privacy', 'uses' => 'StaticController@show'));
Route::get('the_team', array('as' => 'static.the_team', 'uses' => 'StaticController@show'));
Route::get('faq', array('as' => 'static.faq', 'uses' => 'StaticController@show'));
Route::get('class_guidelines', array('as' => 'static.class_guidelines', 'uses' => 'StaticController@show'));
Route::get('contact_us', array('as' => 'static.contact_us', 'uses' => 'StaticController@show'));
Route::get('how_it_works', array('as' => 'static.how_it_works', 'uses' => 'StaticController@show'));
Route::get('test', array('as' => 'static.test', 'uses' => 'StaticController@show'));
Route::post('/postPdf', array('as' => 'postPdf', 'uses' => 'PdfController@postPdf'));
Route::get('video/create', array('as' => 'video', 'uses' => 'VideoController@create'));

// marketing
Route::get('refer_a_friend/{code}', array('as' => 'referral', 'uses' => 'ReferralsController@submitCode'));
Route::get('ppc/{category}/{code}', array('as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc'));
Route::get('ppc_fb/{category}', array('as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc'));
Route::get(
    'dance',
    array('as' => 'landing.dance', 'uses' => function () { return (new LandingsController)->landCategory('dance'); })
);
Route::get(
    'pilates',
    array(
        'as'   => 'landing.pilates',
        'uses' => function () { return (new LandingsController)->landCategory('pilates'); }
    )
);
Route::get(
    'martialarts',
    array(
        'as'   => 'landing.martialarts',
        'uses' => function () { return (new LandingsController)->landCategory('martialarts'); }
    )
);
Route::get(
    'yoga',
    array('as' => 'landing.yoga', 'uses' => function () { return (new LandingsController)->landCategory('yoga'); })
);
Route::get(
    'bootcamp',
    array(
        'as'   => 'landing.bootcamp',
        'uses' => function () { return (new LandingsController)->landCategory('bootcamp'); }
    )
);
Route::get(
    'personaltrainer',
    array(
        'as'   => 'landing.personaltrainer',
        'uses' => function () { return (new LandingsController)->landCategory('personaltrainer'); }
    )
);



/*
// uncomment for sql statement breakdown
Event::listen('illuminate.query', function($sql)
{
    var_dump($sql);
});
*/


Route::get(
    '/email_test',
    function () {
        return View::make('emails.template')
            ->with('title', 'my test email')
            ->with('mainHeader', 'my main header')
            ->with('subHeader', 'My sub Header')
            ->with(
                'body',
                '<p>You now have access to a huge range of fitness classes and trainers operating at multiple locations!</p>
            <br>
            <p>Here are a few tips to get you started.</p>
            <br>
            <ul>
                <li><strong>Search fitness classes:</strong> Simply click “discover classes” on the navigation bar, then search by category or location.</li>
                <li><strong>Sign up to a class online:</strong> Click on the class panel and you will see a list of sessions. Choose the time and date you want, and pay for the class online.</li>
                <li><strong>Show up and shape up:</strong> Make sure you know where to go, at what time you should arrive, how to dress appropriately for the class and if you should bring anything e.g. water.</li>
                <li><strong>Rate and review:</strong> Once you have taken a class, help improve Evercise by rating the class and reviewing your experience.</li>
        '
            )
            ->with('link', HTML::linkRoute('evercisegroups.index', 'Class Hub'))
            ->with('linkLabel', 'you link is here')
            ->with(
                'sellups',
                [
                    0 => [
                        'body'  => 'Gain evercise credits to spend on classes by reommending your friends. for every 3 friend who join due to you referral you will recieve &pounds;3&apos;s of credit and each person who joined will recieve &pound;1 of credit aswell',
                        'image' => HTML::image('img/Sign-Up-Online.png', 'join up', array('class' => 'home-step-img'))
                    ],
                    1 => [
                        'body'  => 'Jeff the trainer',
                        'image' => HTML::image('img/Class.png', 'get fit', array('class' => 'home-step-img'))
                    ]
                ]
            );
    }
);


Route::get('tokens/fb', array('as' => 'tokens.fbtoken', 'uses' => 'TokensController@fb'));
Route::get('/tokens/tw', array('as' => 'tokens.twtoken', 'uses' => 'TokensController@tw'));
Route::get(
    '/twitter',
    array(
        'as'   => 'twitter',
        'uses' => function () {
            // Reqest tokens
            $tokens = Twitter::oAuthRequestToken();

            // Redirect to twitter
            Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
            exit;
        }
    )
);


// working on

Route::get('refer_a_friend/{code}', array('as' => 'referral', 'uses' => 'ReferralsController@submitCode'));
Route::get('ppc/{category}/{code}', array('as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc'));
Route::get('ppc_fb/{category}', array('as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc'));

//Route::get('landing/{category}', array('as' => 'landing.category', 'uses' => 'LandingsController@landingPpc'));
/*Route::get('dance', array('as' => 'landing.dance', 'uses' => 'LandingsController@dance'));
Route::get('pilates', array('as' => 'landing.pilates', 'uses' => 'LandingsController@pilates'));
Route::get('martialarts', array('as' => 'landing.martialarts', 'uses' => 'LandingsController@martialarts'));
Route::get('yoga', array('as' => 'landing.yoga', 'uses' => 'LandingsController@yoga'));
Route::get('bootcamp', array('as' => 'landing.bootcamp', 'uses' => 'LandingsController@bootcamp'));
Route::get('personaltrainer', array('as' => 'landing.personaltrainer', 'uses' => 'LandingsController@personaltrainer'));*/

Route::get(
    'dance',
    array('as' => 'landing.dance', 'uses' => function () { return (new LandingsController)->landCategory('dance'); })
);
Route::get(
    'pilates',
    array(
        'as'   => 'landing.pilates',
        'uses' => function () { return (new LandingsController)->landCategory('pilates'); }
    )
);
Route::get(
    'martialarts',
    array(
        'as'   => 'landing.martialarts',
        'uses' => function () { return (new LandingsController)->landCategory('martialarts'); }
    )
);
Route::get(
    'yoga',
    array('as' => 'landing.yoga', 'uses' => function () { return (new LandingsController)->landCategory('yoga'); })
);
Route::get(
    'bootcamp',
    array(
        'as'   => 'landing.bootcamp',
        'uses' => function () { return (new LandingsController)->landCategory('bootcamp'); }
    )
);
Route::get(
    'personaltrainer',
    array(
        'as'   => 'landing.personaltrainer',
        'uses' => function () { return (new LandingsController)->landCategory('personaltrainer'); }
    )
);





// layout page

Route::get('/layouts', function()
{
    return View::make('layouts.layouts');
});

// -------------  OLD ADMIN STUFF ---------------


Route::post(
    'admin/approve_trainer',
    array('as' => 'admin.approve_trainer.post', 'before' => 'admin', 'uses' => 'AdminController@approveTrainer')
);
Route::get(
    'admin/pending_withdrawal',
    array('as' => 'admin.pending_withdrawal', 'before' => 'admin', 'uses' => 'AdminController@pendingWithdrawal')
);
Route::post(
    'admin/process_withdrawal',
    array('as' => 'admin.process_withdrawal.post', 'before' => 'admin', 'uses' => 'AdminController@processWithdrawal')
);
Route::post(
    '/admin/log',
    array('as' => 'admin.log.delete', 'before' => 'admin', 'uses' => 'AdminController@deleteLog')
);
Route::get(
    '/admin/fakeratings',
    array('as' => 'admin.fakeratings', 'before' => 'admin', 'uses' => 'AdminController@showGroupRatings')
);
Route::post(
    '/admin/edit_classes/{id}',
    array('as' => 'admin.edit_classes', 'before' => 'admin', 'uses' => 'AdminController@editClasses')
);

Route::post(
    '/admin/groups',
    array('as' => 'admin.groups.addcat', 'before' => 'admin', 'uses' => 'AdminController@addCategory')
);

Route::get(
    '/admin/fakeratings',
    array('as' => 'admin.fakeratings', 'before' => 'admin', 'uses' => 'AdminController@showGroupRatings')
);
Route::post(
    '/admin/fakeratings',
    array('as' => 'admin.fakeratings.addrating', 'before' => 'admin', 'uses' => 'AdminController@addRating')
);

// -------------  ADMIN SECTION ---------------

Route::group(
    array('prefix' => 'admin', 'before' => 'admin'),
    function () {

        Route::get('/{page}', ['as' => 'admin.page', 'uses' => 'AdminController@yukon']);
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@yukon']);


        Route::post('/log_in_as', ['as' => 'admin.log_in_as', 'uses' => 'AdminController@logInAs']);
        Route::post('/reset_password', ['as' => 'admin.reset_password', 'uses' => 'AdminController@resetPassword']);
        Route::post('/edit_subcategories', ['as' => 'admin.edit_subcategories', 'uses' => 'AdminController@editSubcategories']);
        Route::post('/add_subcategory', ['as' => 'admin.add_subcategory', 'uses' => 'AdminController@addSubcategory']);
        Route::post('/unapprove_trainer', ['as' => 'admin.unapprove_trainer', 'uses' => 'AdminController@unapproveTrainer']);
        Route::post('/edit_group_subcats', ['as' => 'admin.edit_group_subcats', 'uses' => 'AdminController@editGroupSubcats']);


    }
);
