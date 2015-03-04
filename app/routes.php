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



/* Show home page */
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showWelcome']);
Route::get(
    'popular',
    [
        'as' => 'popular',
        function () {
            return Redirect::to('uk/london');
        }
    ]
);
foreach (Config::get('redirect') as $old => $new) {
    Route::get(
        $old,
        [
            function () use ($new) {
                return Redirect::to($new);
            }
        ]
    );
}


Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'SiteMapController@index']);


Route::get('mindbodytest',
    [
        'before' => 'admin',
        function () {

            $user = Sentry::findUserById(323);



            $mindbody = new Mindbody($user);
            echo "<h4>Purchase Class</h4>";
            d($mindbody->purchaseClass(24376, $user));


            $mindbody = new Mindbody($user);
            echo "<h4>addUserToClass</h4>";
            d($mindbody->addUserToClass(24376, $user), FALSE);





            echo "<h4>getClasses</h4>";
            d($mindbody->getClasses());


            echo "<h4>getSchedules</h4>";
            d($mindbody->getSchedules(), FALSE);
            echo "<h4>getEnrollments</h4>";
            d($mindbody->getEnrollments(), FALSE);
            echo "<h4>getClassSchedules</h4>";
            d($mindbody->getClassSchedules(), FALSE);

        }
    ]
);


/** SEO URLS */
Route::get('/fitness-instructors/{id?}', ['as' => 'trainer.show', 'uses' => 'TrainersController@show']);
Route::get('/classes/{id?}/{preview?}', ['as' => 'class.show', 'uses' => 'EvercisegroupsController@show']);
/** Duplicate Name Added just because of the route URL */
Route::get('/classes/{id?}/{preview?}', ['as' => 'evercisegroups.show', 'uses' => 'EvercisegroupsController@show']);

Route::get('/class/{id}/{preview?}',
    ['as' => 'evercisegroups.show.redirect', 'uses' => 'EvercisegroupsController@show']);


// ajax prefix
Route::group(['prefix' => 'ajax'], function () {
    // register
    Route::post('/users-store', ['as' => 'users.store', 'uses' => 'ajax\UsersController@store']);
    Route::post('/users-guest-store', ['as' => 'users.guest.store', 'uses' => 'ajax\UsersController@storeGuest']);
    Route::post('/users-update', ['as' => 'users.update', 'uses' => 'ajax\UsersController@update']);
    Route::post('/trainers/store', ['as' => 'trainers.store', 'uses' => 'ajax\TrainersController@store']);

    // Location
    Route::post('/users/getLocation',
        ['as' => 'users.location.get', 'uses' => 'ajax\UsersController@getLocation']);
    Route::post('/users/setLocation',
        ['as' => 'users.location.set', 'uses' => 'ajax\UsersController@setLocation']);

    // login
    // login
    Route::post('/auth/login', ['as' => 'auth.login.post', 'uses' => 'ajax\AuthController@postLogin']);

    // Search
    Route::post('/uk/{allsegments}', ['as' => 'ajax.search.parse', 'uses' => 'ajax\SearchController@parseUrl'])->where(
        'allsegments',
        '(.*)?'
    );
    Route::post('/uk/', ['as' => 'ajax.evercisegroups.search', 'uses' => 'ajax\SearchController@parseUrl']);
    Route::post('/map/uk/{allsegments}',
        ['as' => 'ajax.map.search.parse', 'uses' => 'ajax\SearchController@parseMapUrl'])->where(
        'allsegments',
        '(.*)?'
    );
    Route::post('/map/uk/', ['as' => 'ajax.map.evercisegroups.search', 'uses' => 'ajax\SearchController@parseMapUrl']);


    // cart

    // ajax prefix
    Route::group(['prefix' => 'cart'], function () {

        Route::post('add',
            ['as' => 'cart.add', 'uses' => 'ajax\CartController@add']);
        Route::post('remove',
            ['as' => 'cart.remove', 'uses' => 'ajax\CartController@remove']);
        Route::post('delete',
            ['as' => 'cart.delete', 'uses' => 'ajax\CartController@delete']);
        Route::post('empty',
            ['as' => 'cart.emptyCart', 'uses' => 'ajax\CartController@emptyCart']);
        Route::post('coupon',
            ['as' => 'cart.coupon', 'uses' => 'ajax\CartController@applyCoupon']);
        Route::post('wallet_payment',
            ['as' => 'cart.wallet.payment', 'uses' => 'CartController@walletPayment']);

    });


    // sessions
    Route::post('/sessions/inline',
        ['as' => 'sessions.inline.groupId', 'uses' => 'ajax\SessionsController@getSessionsInline']);
    Route::put('/sessions/update', ['as' => 'sessions.update', 'uses' => 'ajax\SessionsController@update']);
    Route::post('sessions/store', ['as' => 'sessions.store', 'uses' => 'ajax\SessionsController@store']);
    Route::post('sessions/remove', ['as' => 'sessions.remove', 'uses' => 'ajax\SessionsController@destroy']);

    Route::post('sessions/getmembers', ['as' => 'session.get.members', 'uses' => 'ajax\SessionsController@getMembers']);


    Route::post('/sessions/getparticipants',
        ['as' => 'sessions.get.participants', 'uses' => 'ajax\SessionsController@getParticipants']);


    // venue
    Route::post('venues/store', ['as' => 'venue.store', 'uses' => 'ajax\VenuesController@store']);
    Route::post('venues/edit', ['as' => 'venue.edit', 'uses' => 'ajax\VenuesController@edit']);

    // evercise groups
    Route::post('evercisegroups',
        ['as' => 'evercisegroups.store', 'before' => 'trainer', 'uses' => 'ajax\EvercisegroupsController@store']);
    Route::post('publish',
        [
            'as'     => 'evercisegroups.publish',
            'before' => 'trainer',
            'uses'   => 'ajax\EvercisegroupsController@publish'
        ]);
    // uploads
    Route::post('upload/cover', ['as' => 'ajax.upload.cover', 'uses' => 'ajax\UploadController@uploadCover']);
    Route::post('upload/profile',
        ['as' => 'ajax.upload.profile', 'uses' => 'ajax\UploadController@uploadProfilePicture']);

    // Upload file only (no crop stuff) for the stupid Safari workaround
    Route::post('upload/basic',
        ['as' => 'ajax.upload.basic', 'uses' => 'ajax\UploadController@uploadWithoutCrop']);

    //Gallery
    Route::post('gallery/getDefaults',
        ['as' => 'ajax.gallery.getdefaults', 'uses' => 'ajax\GalleryController@getDefaults']);

    //Ratings
    Route::post('ratings/store', ['as' => 'ratings.store', 'uses' => 'ajax\RatingsController@store']);


    Route::get('wallet/sessions',
        ['as' => 'wallet.sessions', 'uses' => 'PaymentController@processWalletPaymentSessions']);


    Route::post('withdrawal/request',
        ['as' => 'ajax.request.withdrawal', 'uses' => 'ajax\UsersController@requestWithdrawal']);
    Route::post('withdrawal/process',
        ['as' => 'ajax.process.withdrawal', 'before' => 'trainer', 'uses' => 'ajax\UsersController@makeWithdrawal']);


    Route::post('categories',
        ['as' => 'ajax.categories', 'uses' => 'ajax\CategoryController@getCategories']);

    Route::post('categories/browse',
        ['as' => 'categories.browse', 'uses' => 'ajax\CategoryController@browse']);

});


// Display login page, and redirect to specified page afterwards
Route::get(
    'login',
    [
        'as' => 'auth.login',
        function () {
            if(Session::get('redirect_after_login_url'))
            {
                return View::make('v3.auth.login_page')
                    ->with('redirect_after_login', TRUE)
                    ->with('redirect_after_login_url',Session::get('redirect_after_login_url'))
                    ->with('redirect_after_login_route',Session::get('redirect_after_login_route')); // Route is used for facebook login
            }
            return View::make('v3.auth.login_page')
                ->with('redirect_after_login', FALSE)
                ->with('redirect_after_login_url', FALSE)
                ->with('redirect_after_login_route', FALSE);
        }
    ]
);


/*Route::get('login/fb/{redirect?}', ['as' => 'users.fb', function($redirect = 'no redirect')
{
   return $redirect;
}]);*/
Route::get('login/fb/{redirect?}/{param?}', ['as' => 'users.fb', 'uses' => 'UsersController@fb_login']);

Route::post('auth/checkout', ['as' => 'auth.checkout', 'uses' => 'SessionsController@checkout']);


Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'UsersController@logout']);
Route::get('auth/forgot', ['as' => 'auth.forgot', 'uses' => 'auth\AuthController@getForgot']);
Route::post('auth/forgot', ['as' => 'auth.forgot.post', 'uses' => 'auth\AuthController@postForgot']);

//  Users
Route::get('/register', ['as' => 'register', 'uses' => 'UsersController@create']);

Route::get('/finished-user', [
        'as' => 'finished.user.registration',
        function () {
            new BaseController();

            return View::make('v3.users.complete');
        }
    ]
);

Route::get('/profile/{id}/{tab?}', ['as' => 'users.edit', 'uses' => 'UsersController@edit', 'before' => 'user']);
Route::get('/profile', ['as' => 'profile', 'before' => 'user',
    function () {
        return Redirect::route('users.edit', Sentry::getUser()->display_name);
    }
]);


Route::get(
    '/users/{display_name}/activate/{code}',
    ['as' => 'users.activate', 'uses' => 'UsersController@activate']
);
Route::get(
    '/users/{display_name}/activate',
    ['as' => 'users.activatecodeless', 'uses' => 'UsersController@pleaseActivate']
);
Route::get(
    '/users/{display_name}/resetpassword/{code}',
    ['as' => 'users.resetpassword', 'uses' => 'UsersController@getResetPassword']
);
Route::post(
    '/users/resetpassword',
    ['as' => 'users.resetpassword.post', 'uses' => 'UsersController@postResetPassword']
);
Route::post(
    '/users/changepassword',
    ['as' => 'users.changepassword.post', 'before' => 'user', 'uses' => 'UsersController@postChangePassword']
);
Route::get('/users/{display_name}/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);

// trainers
Route::group(['prefix' => 'trainers'], function () {
    Route::get('/create', ['as' => 'trainers.create', 'uses' => 'TrainersController@create']);
    Route::get('/me', ['as' => 'trainer', 'uses' => 'TrainersController@show']);
    Route::get('/{id}/edit', ['as' => 'trainers.edit', 'uses' => 'TrainersController@edit']);
    Route::get('/{id}', ['as' => 'trainers.show', 'uses' => 'TrainersController@show']);
    Route::get('/{id}/edit/{tab}', ['as' => 'trainers.edit.tab', 'uses' => 'TrainersController@edit']);
    Route::put('/update/{id}', ['as' => 'trainers.update', 'uses' => 'TrainersController@update']);
});

// evercisegroups (classes)
Route::get(
    'evercisegroups',
    ['as' => 'evercisegroups.index', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@index']
);
Route::get(
    'evercisegroups/create/{clone_id?}',
    ['as' => 'evercisegroups.create', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@create']
);

Route::get(
    '/clone_class/{id}',
    ['as' => 'clone_class', 'uses' => 'EvercisegroupsController@cloneEG']
);
Route::post(
    '/evercisegroups/delete/{id}',
    ['as' => 'evercisegroups.delete', 'uses' => 'EvercisegroupsController@deleteEG']
);

/** Landing Pages */
foreach (Config::get('landing_pages') as $url => $params) {

    Route::get($url,
        ['as' => 'landing_page.' . str_replace('/', '.', $url), 'uses' => 'LandingsController@display']
    );
}

Route::get('/trainers',
    ['as' => 'landing.trainer.ppc', 'uses' => 'LandingsController@trainerPpc']
);


//Redirect All UK segments to the same function and we will go from there
Route::any('/uk/{allsegments}', ['as' => 'search.parse', 'uses' => 'SearchController@parseUrl'])->where(
    'allsegments',
    '(.*)?'
);
Route::any('/uk/', ['as' => 'evercisegroups.search', 'uses' => 'SearchController@parseUrl']);

Route::get('confo', [
    'as' => 'con',
    function () {
        return View::make('v3.cart.confirmation');
    }
]);

// Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('checkout/{step?}',
        ['as' => 'cart.checkout', 'uses' => 'CartController@checkout']);
    Route::get('confirm',
        ['as' => 'cart.confirm', 'uses' => 'CartController@confirm']);
    Route::get('guest',
        ['as' => 'cart.guest', 'uses' => 'UsersController@guestCheckout']);


    Route::get('payment.error',
        ['as' => 'payment.error', 'uses' => 'CartController@paymentError']);
    Route::get('cartrow', [
        'as' => 'cart.row',
        function () {
            return View::make('v3.cart.cartrow');
        }
    ]);
});


Route::get('transaction/{id}',
    ['as' => 'transaction.show', 'uses' => 'TransactionController@show']
);
Route::get('transaction/{id}/download',
    ['as' => 'transaction.download', 'uses' => 'TransactionController@download']
);


// sessions

Route::get(
    'sessions/{evercisegroup_id}/index',
    ['as' => 'evercisegroups.trainer_show', 'uses' => 'SessionsController@index']
);
Route::get('sessions/add/{id}', ['as' => 'sessions.add', 'uses' => 'SessionsController@create']);
Route::get('sessions/date_list', ['as' => 'sessions.date_list']);
Route::get('/sessions/{id}', ['as' => 'sessions.show', 'uses' => 'SessionsController@show']);

/* New Stripe payment */
Route::post('stripe/sessions',
    ['as' => 'stripe.sessions', 'uses' => 'PaymentController@processStripePaymentSessions']);
Route::post('stripe/topup', ['as' => 'stripe.topup', 'uses' => 'PaymentController@processStripePaymentTopup']);
Route::get('topup_confirmation', ['as' => 'topup_confirmation', 'uses' => 'PaymentController@topupConfirmation']);
Route::get('topup', ['as' => 'topup', 'uses' => 'PaymentController@topup']);
/* ------------------ */

/* Wallet only payment */
Route::get('wallet/sessions',
    ['as' => 'wallet.sessions', 'uses' => 'PaymentController@processWalletPaymentSessions']);
/* ------------------ */

/* Show payment confirmation */
Route::get('checkout/confirmation',
    ['as' => 'checkout.confirmation', 'uses' => 'PaymentController@showConfirmation']);
/* ------------------ */

Route::get('payment/error',
    ['as' => 'payment.error', 'uses' => 'PaymentController@paymentError']);

Route::get('payment/proccess/paypal',
    ['as' => 'payment.process.paypal', 'uses' => 'PaymentController@processPaypalPaymentSessions']);

Route::get('payment/request/paypal',
    ['as' => 'payment.request.paypal', 'uses' => 'PaymentController@requestPaypalPaymentSessions']);

Route::get('payment/proccess/paypal/topup',
    ['as' => 'payment.process.paypal.topup', 'uses' => 'PaymentController@processPaypalPaymentTopUp']);

Route::get('payment/request/paypal/topup',
    ['as' => 'payment.request.paypal.topup', 'uses' => 'PaymentController@requestPaypalPaymentTopUp']);

Route::get('payment/cancelled',
    ['as' => 'payment.cancelled', 'uses' => 'PaymentController@cancelled']);

// payment (old)
Route::get(
    'sessions/{evercisegroupId}/paywithstripe',
    ['as' => 'sessions.pay.stripe', 'uses' => 'SessionsController@payForSessionsStripe']
);

Route::post(
    'wallets/{userId}/update_paypal',
    ['as' => 'wallets.updatepaypal', 'uses' => 'WalletsController@updatePaypal']
);
Route::get(
    '/sessions/{evercisegroupId}/paywithevercoins',
    function ($evercisegroupId) {
        return Redirect::to('evercisegroups/' . $evercisegroupId);
    }
);


// mail
Route::get('/sessions/{sessionId}/mail_all', ['as' => 'sessions.mail_all', 'uses' => 'SessionsController@getMailAll']);
Route::post(
    '/sessions/{sessionId}/mail_all',
    ['as' => 'sessions.mail_all.post', 'uses' => 'SessionsController@postMailAll']
);
Route::get('/sessions/{sessionId}/mail_one/{userId}',
    ['as' => 'sessions.mail_one', 'uses' => 'SessionsController@getMailOne']
);
Route::post('/sessions/{sessionId}/mail_one/{userId}',
    ['as' => 'sessions.mail_one.post', 'uses' => 'SessionsController@postMailOne']
);
Route::get('/sessions/{sessionId}/mail_trainer/{trainerId}',
    ['as' => 'sessions.mail_trainer', 'uses' => 'SessionsController@getMailTrainer']
);
Route::post('/sessions/{sessionId}/mail_trainer/{trainerId}',
    ['as' => 'sessions.mail_trainer.post', 'uses' => 'SessionsController@postMailTrainer']
);

Route::get('/conversation/{displayName}',
    ['as' => 'conversation', 'uses' => 'MessageController@getConversation', 'before' => 'user']
);
Route::post('/conversation/{displayName}',
    ['as' => 'conversation.post', 'uses' => 'MessageController@postMessage']
);

Route::get('/fitness-packages', ['as' => 'packages', 'uses' => 'PackagesController@index']);


// layouts and static pages
Route::get('blog', ['as' => 'blog', 'uses' => 'PagesController@showBlog']);


Route::get('about-evercise', [
    'as' => 'general.about',
    function () {
        return View::make('v3.pages.about');
    }
]);
Route::get('terms-of-use', [
    'as' => 'general.terms',
    function () {
        return View::make('v3.pages.terms');
    }
]);

// ------------ STATIC PAGES ---------------
Route::get('privacy', ['as' => 'static.privacy']);
Route::get('leadership-team', ['as' => 'static.the_team']);
Route::get('faq', ['as' => 'static.faq']);
Route::get('careers', ['as' => 'static.careers']);
Route::get('fitness-class-guidelines', ['as' => 'static.class_guidelines']);
Route::get('contact_us', ['as' => 'static.contact_us']);
Route::get('how_it_works', ['as' => 'static.how_it_works']);
// ------------ ------------ ---------------

Route::post('/postPdf', ['as' => 'postPdf', 'uses' => 'PdfController@postPdf']);
Route::get('/download_user_list/{session_id}', ['as' => 'getPdf', 'uses' => 'PdfController@getPdf']);
Route::get('video/create', ['as' => 'video', 'uses' => 'VideoController@create']);

// marketing
Route::get('refer_a_friend/{code}', ['as' => 'referral', 'uses' => 'ReferralsController@submitCode']);
Route::get('ppc/{category}/{code}', ['as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc']);
Route::get('ppc_fb/{category}', ['as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc']);
Route::post('landing/send', ['as' => 'landings.send', 'uses' => 'LandingsController@landingSend']);
Route::post('landing/enquiry', ['as' => 'landings.enquiry', 'uses' => 'LandingsController@trainerEnquiry']);

Route::post('new_referral', ['as' => 'new_referral', 'uses' => 'ReferralsController@store']);


Route::group(['prefix' => 'tokens'], function () {
    Route::get('/fb', ['as' => 'tokens.fbtoken', 'uses' => 'TokensController@fb']);
    Route::get('/tw', ['as' => 'tokens.twtoken', 'uses' => 'TokensController@tw']);
});

Route::get(
    '/twitter',
    [
        'as'   => 'twitter',
        'uses' => function () {
            // Reqest tokens
            $tokens = Twitter::oAuthRequestToken();

            // Redirect to twitter
            Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
            exit;
        }
    ]
);

/** ARTICLES */
if (Schema::hasTable('articles')) {
    $pagesController = App::make('PagesController');
    $pagesController->generateRoutes();
}


$landings = ['dance', 'pilates', 'martialarts', 'yoga', 'bootcamp', 'personaltrainer'];

foreach ($landings as $land) {
    Route::get($land, [
        'as'   => 'landing.bootcamp',
        'uses' => function () use ($land) {
            $lc = App::make('LandingsController');

            return $lc->landCategory($land);
        }
    ]);
}


// -------------  ADMIN STUFF ---------------

// -------------  ADMIN SECTION ---------------
Route::get('/admin/', ['as' => 'admin.page', 'uses' => 'AdminController@dashboard', 'before' => 'admin']);
Route::get('/admin/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard', 'before' => 'admin']);
Route::get('/admin/', ['as' => 'users.create', 'uses' => 'AdminController@dashboard', 'before' => 'admin']);

Route::group(['prefix' => 'ajax/admin', 'before' => 'admin'], function () {

    Route::post('check_url',
        ['as' => 'admin.ajax.check_url', 'uses' => 'AdminAjaxController@ajaxCheckUrl']);
    Route::post('/reset_password',
        ['as' => 'admin.reset_password', 'uses' => 'AdminAjaxController@resetPassword']);

    Route::post('/fakeratings',
        ['as' => 'admin.fakeratings.addrating', 'uses' => 'AdminAjaxController@addRating']);


    Route::post('/update_categories',
        ['as' => 'admin.update_categories', 'uses' => 'AdminAjaxController@updateCategories']);
    Route::post('/update_category',
        ['as' => 'admin.update_category', 'uses' => 'AdminAjaxController@updateCategory']);

    Route::post('/edit_subcategories',
        ['as' => 'admin.edit_subcategories', 'uses' => 'AdminAjaxController@editSubcategories']);
    Route::post('/add_subcategory',
        ['as' => 'admin.add_subcategory', 'uses' => 'AdminAjaxController@addSubcategory']);
    Route::post('/edit_group_subcats',
        ['as' => 'admin.edit_group_subcats', 'uses' => 'AdminAjaxController@editGroupSubcats']);
    Route::post('/subcategory/delete',
        ['as' => 'ajax.admin.subcategory.delete', 'uses' => 'AdminAjaxController@deleteSubcategory']);

    Route::post('/unapprove_trainer',
        ['as' => 'admin.unapprove_trainer', 'uses' => 'AdminAjaxController@unapproveTrainer']);

    Route::get('/search/stats',
        ['as' => 'admin.ajax.searchstats', 'uses' => 'AdminAjaxController@searchStats']);
    Route::post('/search/stats/download',
        ['as' => 'admin.ajax.searchstats.download', 'uses' => 'AdminAjaxController@downloadStats']);

    Route::post('galleryImageUpload',
        ['as' => 'admin.ajax.gallery_upload', 'uses' => 'AdminAjaxController@galleryUploadFile']);
    Route::post('saveTags',
        ['as' => 'admin.ajax.saveTags', 'uses' => 'AdminAjaxController@saveTags']);
    Route::post('deleteGalleryImage',
        ['as' => 'admin.ajax.gallery_delete', 'uses' => 'AdminAjaxController@deleteGalleryImage']);


    Route::post('set_class_image',
        ['as' => 'admin.ajax.set_image', 'uses' => 'AdminAjaxController@setClassImage']);


    Route::post('featureClass',
        ['as' => 'admin.ajax.featureClass', 'uses' => 'AdminAjaxController@featureClass']);
    Route::post('sliderUpload',
        ['as' => 'admin.ajax.slider_upload', 'uses' => 'AdminAjaxController@sliderUpload']);
    Route::post('sliderStatus',
        ['as' => 'admin.ajax.sliderStatus', 'uses' => 'AdminAjaxController@sliderStatus']);


    Route::delete(
        '/evercisegroups/delete',
        ['as' => 'admin.ajax.delete.class', 'before' => 'admin', 'uses' => 'AdminAjaxController@deleteClass']
    );

    Route::get('modal/categories/{id?}',
        ['as' => 'ajax.admin.modal.categories', 'uses' => 'AdminAjaxController@modalClassCategories']);

    Route::get('/importStatsToDB',
        ['as' => 'ajax.admin.import.stats', 'uses' => 'AdminAjaxController@importStatsToDB']);


    Route::put('modal/categories',
        ['as' => 'ajax.admin.modal.categories.save', 'uses' => 'AdminAjaxController@saveClassCategories']);


    Route::post('runindexer',
        ['as' => 'ajax.admin.indexall', 'uses' => 'AdminAjaxController@runIndexer']);

    Route::delete(
        '/seourls/delete',
        ['as' => 'admin.ajax.delete.seourls', 'before' => 'admin', 'uses' => 'AdminAjaxController@deleteSeoUrl']
    );
    Route::post('search_places',
        ['as' => 'admin.ajax.search_places', 'uses' => 'AdminAjaxController@searchPlaces']);

    Route::post('/pending_evercisegroups/delete',
        ['as' => 'pending_evercisegroups.delete', 'uses' => 'AdminAjaxController@deletePendingClass']);
    Route::post('/approve_class',
        ['as' => 'admin.ajax.approve_class', 'uses' => 'AdminAjaxController@approveClass']);

});


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
        Route::post('/pending_withdrawal_multi',
            ['as' => 'admin.pending.process', 'uses' => 'MainController@processWithdrawalMulti']);
        Route::post('/process_withdrawal',
            ['as' => 'admin.process_withdrawal', 'uses' => 'MainController@processWithdrawal']);


        Route::get('/categories',
            ['as' => 'admin.categories', 'uses' => 'MainController@editCategories']);
        Route::get('categories/{id?}',
            ['as' => 'admin.categories.manage', 'uses' => 'MainController@categoriesManage']);

        Route::get('/subcategories',
            ['as' => 'admin.subcategories', 'uses' => 'MainController@subcategories']);

        Route::get('/seourls',
            ['as' => 'admin.seourls', 'uses' => 'MainController@seoUrls']);
        Route::get('seourls/{id?}',
            ['as' => 'admin.seourls.manage', 'uses' => 'MainController@seoUrlsManage']);
        Route::post('/update_seourl',
            ['as' => 'admin.update_seourl', 'uses' => 'MainController@updateSeoUrl']);

        Route::get('/pendinggroups',
            ['as' => 'admin.pendinggroups', 'uses' => 'MainController@pendingGroups']);
        Route::get('pendinggroups/{id?}',
            ['as' => 'admin.pendinggroups.manage', 'uses' => 'MainController@pendinggroupsManage']);
        Route::get('pendingnewgroups/{id?}',
            ['as' => 'admin.pendinggroups.new.manage', 'uses' => 'MainController@pendingNewGroupManage']);
        Route::get('/create_class_update/{id?}',
            ['as' => 'admin.create_class_update', 'uses' => 'MainController@createClassUpdate']);

        Route::get('/listclasses',
            ['as' => 'admin.listClasses', 'uses' => 'MainController@listClasses']);


        Route::get('articles',
            ['as' => 'admin.articles', 'uses' => 'ArticlesController@articles']);
        Route::get('article/delete/{id?}',
            ['as' => 'admin.article.delete', 'uses' => 'ArticlesController@deleteArticle']);

        Route::match(['GET', 'POST'], 'article/manage/{id?}',
            ['as' => 'admin.article.manage', 'uses' => 'ArticlesController@manage']);
        Route::get('article/categories',
            ['as' => 'admin.article.categories', 'uses' => 'ArticlesController@categories']);
        Route::get('article/categories/{id?}',
            ['as' => 'admin.article.categories.manage', 'uses' => 'ArticlesController@categoriesManage']);
        Route::match(['GET', 'POST'], 'article/categories/{id?}',
            ['as' => 'admin.article.categories.manage', 'uses' => 'ArticlesController@categoriesManage']);


        Route::get('/search/stats',
            ['as' => 'admin.searchstats', 'uses' => 'MainController@searchStats']);

        Route::get('/sales',
            ['as' => 'admin.sales', 'uses' => 'MainController@salesStats']);

        Route::get('/transactions',
            ['as' => 'admin.transactions', 'uses' => 'MainController@transactions']);

        Route::get('/packages',
            ['as' => 'admin.packages', 'uses' => 'MainController@userPackages']);

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
            ['as' => 'admin.groups.addcat', 'uses' => 'MainController@addCategory']);
        Route::get('/fakeratings',
            ['as' => 'admin.fakeratings', 'uses' => 'MainController@showGroupRatings']);


        Route::get('expired/{date?}',
            ['as' => 'admin.expired', 'uses' => 'MainController@expired']);

        Route::get('landings',
            ['as' => 'admin.landings', 'uses' => 'MainController@landings']);
        Route::get('landing/{id?}',
            ['as' => 'admin.landing.manage', 'uses' => 'MainController@landing']);


    }


);

/*
Route::get('makestaticlandingcode', function(){
    StaticLanding::create(['code'=>'89o7645v68h6345']);
});

Route::get('generatestaticlandingemail', function(){
    // Make sure line '$this->log->info($view);' in Mail/send is uncommented, to get generated email in log
    $code = StaticLanding::find(1)->code;
    //return View::make('v3.emails.user.static_landing_email')->with('ppcCode', StaticLanding::find(1)->code);
    event('generate.static.landing.email', [$code, 0]);

    return 'generated. code: '.$code;
});
*/
Route::get('ping', ['as' => 'ping.me', 'uses' => 'PingController@check']);

Route::get('/evercisegroups/{id?}/{preview?}', ['as' => 'class.show.eg', 'uses' => 'EvercisegroupsController@show']);

Route::any('emailgrab', ['as' => 'email.grab', 'uses' => 'EmailGrabber@grab']);

Route::get('cleansubcategoriesup', function () {

    $subcategories = Subcategory::get();

    foreach ($subcategories as $sc) {
        $n = $sc['name'];
        //return var_dump($n);
        //if ($n != 'dance' && $n != 'belly dancing')
        //return ucfirst($n);
        $sc->name = ucfirst($n);
        $sc->save();
    }

});


/*
Route::get('test1', function () {

    $trainer = User::find('169');

    event('trainer.registered_ppc', [$trainer]);

    return 'event fired : ' . $trainer->display_name;

});
Route::get('test2', function () {

    $transaction = \Transactions::find(5318091);
    $hashes = $transaction->makeBookingHashBySession('1479');

    $output = '';
    foreach ($hashes as $hash) {
        $output .= $hash . ',';
    }

    return $output;
});
Route::get('test3', function () {
    $cart = EverciseCart::getCart();

    $upperPrice = round($cart['packages'][0]['max_class_price'], 2) + 0.01;
    //Log::live()
    // $everciseGroups = Evercisegroup::whereHas('futuresessions', function($query) use($packagePrice) {
     //    $query->where('price', '<', $packagePrice);
     //})->take(3)->get();

    $searchController = App::make('SearchController');
    $everciseGroups = $searchController->getClasses([
        'sort'  => 'price_desc',
        'price' => ['under' => round($upperPrice, 2), 'over' => round(($upperPrice - 10))],
        'size'  => '3'
    ]);

    return var_dump($everciseGroups);
});

Route::get('test4/{term}', function ($term) {

    return Subcategory::getRelatedFromSearch($term);
});
*/

