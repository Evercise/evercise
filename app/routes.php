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

Route::get('/popular', [
        'as' => 'popular',
        function () {
            return View::make('v3.home');
        }
    ]
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
Route::group(['prefix' => 'ajax'], function () {
    // register
    Route::post('/users-store', array('as' => 'users.store', 'uses' => 'ajax\UsersController@store'));
    // login
    Route::post('/auth/login', array('as' => 'auth.login.post', 'uses' => 'ajax\AuthController@postLogin'));
    // cart
    Route::post('cart/add', array('as' => 'cart.add', 'uses' => 'ajax\CartController@add'));
    Route::post('cart/remove', array('as' => 'cart.remove', 'uses' => 'ajax\CartController@remove'));
    Route::post('cart/delete', array('as' => 'cart.delete', 'uses' => 'ajax\CartController@delete'));
    Route::post('cart/empty', array('as' => 'cart.emptyCart', 'uses' => 'ajax\CartController@emptyCart'));
    Route::post('cart/wallet_payment', ['as' => 'cart.wallet.payment', 'uses' => 'CartController@walletPayment']);
    // sessions
    Route::post('/sessions/inline', ['as'=>'sessions.inline.groupId', 'uses'=>'ajax\SessionsController@getSessionsInline'] );
    Route::put('/sessions/update', ['as'=>'sessions.update', 'uses'=>'ajax\SessionsController@update']);
    Route::post('sessions/store', [ 'as' => 'sessions.store', 'uses' => 'ajax\SessionsController@store' ]);
    Route::post('sessions/remove', array('as' => 'sessions.remove', 'uses' => 'ajax\SessionsController@destroy'));

    // venue
    Route::post('venues/store', ['as' => 'venue.store', 'uses' => 'ajax\VenuesController@store']);

    // evercise groups
    Route::post( 'evercisegroups', ['as' => 'evercisegroups.store', 'before' => 'trainer', 'uses' => 'ajax\EvercisegroupsController@store'] );
    // uploads
    Route::post('upload/cover', array('as' => 'ajax.upload.cover', 'uses' => 'ajax\UploadController@uploadCover'));

    //Gallery
    Route::post('gallery/getDefaults', array('as' => 'ajax.gallery.getdefaults', 'uses' => 'ajax\GalleryController@getDefaults'));
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


Route::get('auth/logout', array('as' => 'auth.logout', 'uses' => 'auth\AuthController@getLogout'));
Route::get('auth/forgot', array('as' => 'auth.forgot', 'uses' => 'auth\AuthController@getForgot'));
Route::post('auth/forgot', array('as' => 'auth.forgot.post', 'uses' => 'auth\AuthController@postForgot'));

//  Users
Route::get('/register', array('as' => 'register', 'uses' => 'UsersController@create'));
Route::get('/finished-user', [
        'as' => 'finished.user.registration',
        function () {
            new BaseController();
            return View::make('v3.users.complete');
        }
    ]
);

Route::get('/profile/{id}', [ 'as' => 'users.edit', 'uses' => 'UsersController@edit'] );


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

Route::get('/class/{id}', array('as' => 'evercisegroups.show', 'uses' => 'EvercisegroupsController@show'));
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
Route::post('venues/update/{id}', 'VenuesController@update');


// Cart
Route::get('cart/checkout', array('as' => 'cart.checkout', 'uses' => 'CartController@getCart'));
Route::get('cartrow', array('as' => 'cart.row', function () {
    return View::make('v3.cart.cartrow');
}));


// sessions

Route::get(
    'sessions/{evercisegroup_id}/index',
    array('as' => 'evercisegroups.trainer_show', 'uses' => 'SessionsController@index')
);
Route::get('sessions/add/{id}', ['as' => 'sessions.add', 'uses' => 'SessionsController@create']);
Route::get('sessions/date_list', array('as' => 'sessions.date_list'));
Route::post('sessions/join', array('as' => 'sessions.join', 'uses' => 'SessionsController@joinSessions'));
Route::get('sessions/join/class', array('as' => 'sessions.join.get', 'uses' => 'SessionsController@joinSessions'));
Route::get('/sessions/{id}', array('as' => 'sessions.show', 'uses' => 'SessionsController@show'));
Route::get(
    '/sessions/{sessionId}/leave',
    array('as' => 'sessions.leave', 'uses' => 'SessionsController@getLeaveSession')
);
Route::post(
    '/sessions/{sessionId}/leave',
    array('as' => 'sessions.leave.post', 'uses' => 'SessionsController@postLeaveSession')
);

/* New Stripe payment */
Route::post('stripe/sessions', array('as' => 'stripe.sessions', 'uses' => 'PaymentController@processStripePaymentSessions'));
Route::post('stripe/topup', array('as' => 'stripe.topup', 'uses' => 'PaymentController@processStripePaymentTopup'));
Route::get('payment_confirmation', ['as' => 'payment_confirmation', 'uses' => 'PaymentController@sessionConfirmation']);
Route::get('topup_confirmation', ['as' => 'topup_confirmation', 'uses' => 'PaymentController@topupConfirmation']);
Route::get('topup', ['as' => 'topup', 'uses' => 'PaymentController@topup']);
/* ------------------ */

// payment (old)
Route::get(
    'sessions/{evercisegroupId}/paywithstripe',
    array('as' => 'sessions.pay.stripe', 'uses' => 'SessionsController@payForSessionsStripe')
);

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
Route::get( '/sessions/{sessionId}/mail_one/{userId}',
    array('as' => 'sessions.mail_one', 'uses' => 'SessionsController@getMailOne')
);
Route::post('/sessions/{sessionId}/mail_one/{userId}',
    array('as' => 'sessions.mail_one.post', 'uses' => 'SessionsController@postMailOne')
);
Route::get('/sessions/{sessionId}/mail_trainer/{trainerId}',
    array('as' => 'sessions.mail_trainer', 'uses' => 'SessionsController@getMailTrainer')
);
Route::post('/sessions/{sessionId}/mail_trainer/{trainerId}',
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
Route::get('blog', array('as' => 'blog', 'uses' => 'PagesController@showBlog'));




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

Route::post('referral', array('as' => 'referral', 'uses' => 'ReferralsController@store'));


Route::get('tokens/fb', array('as' => 'tokens.fbtoken', 'uses' => 'TokensController@fb'));
Route::get('/tokens/tw', array('as' => 'tokens.twtoken', 'uses' => 'TokensController@tw'));
Route::get(
    '/twitter',
    array(
        'as' => 'twitter',
        'uses' => function () {
            // Reqest tokens
            $tokens = Twitter::oAuthRequestToken();

            // Redirect to twitter
            Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
            exit;
        }
    )
);

/** ARTICLES */

$pagesController = App::make('PagesController');
$pagesController->generateRoutes();


// working on

Route::get('refer_a_friend/{code}', array('as' => 'referral', 'uses' => 'ReferralsController@submitCode'));
Route::get('ppc/{category}/{code}', array('as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc'));
Route::get('ppc_fb/{category}', array('as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc'));



$landings = ['dance', 'pilates','martialarts', 'yoga', 'bootcamp', 'personaltrainer'];

foreach($landings as $land) {
    Route::get($land,['as' => 'landing.bootcamp', 'uses' => function () use ($land) {
        return (new LandingsController)->landCategory($land);
    }]);
}



// layout page

Route::get('/layouts', function () {
    return View::make('layouts.layouts');
});




// -------------  ADMIN SECTION ---------------
Route::get('/admin/', ['as' => 'admin.page', 'uses' => 'AdminController@dashboard']);
Route::get('/admin/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);
Route::get('/admin/', ['as' => 'users.create', 'uses' => 'AdminController@dashboard']);

Route::group(array('prefix' => 'ajax/admin', 'before' => 'admin'), function () {

    Route::post('check_url',
        ['as' => 'admin.ajax.check_url', 'uses' => 'AdminAjaxController@ajaxCheckUrl']);
    Route::post('/reset_password',
        ['as' => 'admin.reset_password', 'uses' => 'AdminAjaxController@resetPassword']);

    Route::post('/fakeratings',
        ['as' => 'admin.fakeratings.addrating', 'uses' => 'AdminAjaxController@addRating']);


    Route::post('/edit_subcategories',
        ['as' => 'admin.edit_subcategories', 'uses' => 'AdminAjaxController@editSubcategories']);
    Route::post('/add_subcategory',
        ['as' => 'admin.add_subcategory', 'uses' => 'AdminAjaxController@addSubcategory']);
    Route::post('/edit_group_subcats',
        ['as' => 'admin.edit_group_subcats', 'uses' => 'AdminAjaxController@editGroupSubcats']);

    Route::post('/unapprove_trainer',
        ['as' => 'admin.unapprove_trainer', 'uses' => 'AdminAjaxController@unapproveTrainer']);

    Route::get('/search/stats',
        ['as' => 'admin.ajax.searchstats', 'uses' => 'AdminAjaxController@searchStats']);



    Route::post('galleryImageUpload',
        ['as' => 'admin.ajax.gallery_upload', 'uses' => 'AdminAjaxController@galleryUploadFile']);
    Route::post('saveTags',
        ['as' => 'admin.ajax.saveTags', 'uses' => 'AdminAjaxController@saveTags']);
    Route::post('deleteGalleryImage',
        ['as' => 'admin.ajax.gallery_delete', 'uses' => 'AdminAjaxController@deleteGalleryImage']);


});


Route::get('/iggy_login', function() {
    Sentry::logout();
    $user = Sentry::findUserById(323);
    Sentry::login($user);

    return Redirect::route('admin.dashboard');
});

// -------------  ADMIN STUFF ---------------


Route::group(
    ['prefix' => 'admin', 'before' => 'admin'],
    function () {
        Route::get('/dashboard',
            ['as' => 'admin.dashboard', 'uses' => 'MainController@dashboard']);


        /** USERS */
        Route::get('/users',
            ['as' => 'admin.users', 'uses' => 'MainController@users']);
        Route::get('/users/trainer',
            ['as' => 'admin.users.trainerCreate', 'uses' => 'MainController@trainerCreate']);
        Route::post('/users/trainer',
            ['as' => 'admin.users.trainerStore', 'uses' => 'MainController@trainerStore']);

        Route::post('/log_in_as',
            ['as' => 'admin.log_in_as', 'uses' => 'MainController@logInAs']);
        Route::get('/pendingtrainers',
            ['as' => 'admin.pendingtrainers', 'uses' => 'MainController@pendingTrainers']);
        Route::post('/approve_trainer',
            ['as' => 'admin.approve_trainer', 'uses' => 'MainController@approveTrainer']);
        Route::get('/pending_withdrawal',
            ['as' => 'admin.pending_withdrawal', 'uses' => 'MainController@pendingWithdrawal']);
        Route::post('/process_withdrawal',
            ['as' => 'admin.process_withdrawal', 'uses' => 'MainController@processWithdrawal']);



        Route::get('/categories',
            ['as' => 'admin.categories', 'uses' => 'MainController@categories']);
        Route::get('/subcategories',
            ['as' => 'admin.subcategories', 'uses' => 'MainController@subcategories']);


        Route::get('articles',
            ['as' => 'admin.articles', 'uses' => 'ArticlesController@articles']);
        Route::get('article/delete/{id?}',
            ['as' => 'admin.article.delete', 'uses' => 'ArticlesController@deleteArticle']);

        Route::match(array('GET', 'POST'), 'article/manage/{id?}',
            ['as' => 'admin.article.manage', 'uses' => 'ArticlesController@manage']);
        Route::get('article/categories',
            ['as' => 'admin.article.categories', 'uses' => 'ArticlesController@categories']);
        Route::get('article/categories/{id?}',
            ['as' => 'admin.article.categories.manage', 'uses' => 'ArticlesController@categoriesManage']);
        Route::match(array('GET', 'POST'), 'article/categories/{id?}',
            ['as' => 'admin.article.categories.manage', 'uses' => 'ArticlesController@categoriesManage']);


        Route::get('/search/stats',
            ['as' => 'admin.searchstats', 'uses' => 'MainController@searchStats']);

        Route::get('/gallery',
            ['as' => 'admin.gallery', 'uses' => 'AdminGalleryController@index']);

        /** TO DOOO */

        Route::get('log',
            ['as' => 'admin.log', 'uses' => 'MainController@showLog']);
        Route::post('/log',
            ['as' => 'admin.log.delete', 'uses' => 'MainController@deleteLog']);
        Route::get('/fakeratings',
            ['as' => 'admin.fakeratings', 'uses' => 'MainController@showGroupRatings']);
        Route::post('/edit_classes/{id}',
            ['as' => 'admin.edit_classes', 'uses' => 'MainController@editClasses']);
        Route::post('/groups',
            ['as' => 'admin.groups.addcat','uses' => 'MainController@addCategory']);
        Route::get('/fakeratings',
            ['as' => 'admin.fakeratings', 'uses' => 'MainController@showGroupRatings']);


        Route::get('expired/{date?}',
            ['as' => 'admin.expired', 'uses' => 'MainController@expired']);
    }


);

Route::get('newvenue', function(){
    $venue = Venue::validateAndStore(['venue_name' => 'name2', 'street' => 'street2', 'city' => 'city2', 'postcode' => 'postcode2'], '169');
    return var_dump($venue);
});
Route::get('updatevenue/{id}', function($id){
    $venue = Venue::find($id)->validateAndUpdate(['venue_name' => 'edited1', 'street' => 'edited1', 'city' => 'edited1', 'postcode' => 'edited1', 'facilities_array' => ['4', '5']]);
    return var_dump($venue);
});

Route::get('updategroup/{id}', function($id){
    $result = Evercisegroup::find($id)->validateAndUpdate([
        'class_name'=>'Running or something',
        'venue_select'=>'28',
        'class_description'=>'changed2 changed1 changed1 changed1 changed1 changed1 changed1 changed1 changed1 changed1updategroupupdategroup ',
        'image'=>'changed1',
        'category_array'=>['1', '2'],
    ], Sentry::getUser());
    return var_dump($result);
});

Route::get('creategroup', function(){
    $result = Evercisegroup::validateAndStore([
        'class_name'=>'Fancy shit',
        'venue_select'=>'28',
        'class_description'=>'new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one ',
        'image'=>'image.jpg',
        'category_array'=>['4'],
    ], Sentry::getUser());
    return var_dump($result);
});

Route::get('show_amenities/{venueId}', function($id){
        return Venue::find($id)->getAmenities($id);
    }
);
Route::get('show_facilities/{venueId}', function($id){
        return Venue::find($id)->getFacilities($id);
    }
);