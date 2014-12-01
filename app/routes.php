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

Route::get('/ig', [
        'as' => 'aaa',
        function () {

            $class = Evercisegroup::find(721);
            $user = Sentry::getUser();
            $session = Evercisesession::find(5594);

            /**
             *
            ['activity.class.payed' => 'Activity@payedClass'],  // $class, $user √
            ['activity.class.canceled' => 'Activity@canceledClass'],  // $class, $user
            ['activity.class.create' => 'Activity@createdClass'],  // $class, $user
            ['activity.class.update' => 'Activity@updatedClass'],  // $class, $user
            ['activity.class.delete' => 'Activity@deletedClass'],  // $class, $user
            ['activity.venue.create' => 'Activity@createdVenue'],  // $venue, $user
            ['activity.venue.update' => 'Activity@updatedVenue'],  // $venue, $user
            ['activity.venue.delete' => 'Activity@deletedVenue'],  // $venue, $user

            ['activity.session.create' => 'Activity@createdSessions'],  // $class, $user
            ['activity.session.update' => 'Activity@updatedSessions'],  // $class, $user
            ['activity.session.delete' => 'Activity@deletedSessions'],  // $class, $user

            ['activity.wallet.topup' => 'Activity@walletToppup'],  // $user, $amount
            ['activity.wallet.withdraw' => 'Activity@walletWithdraw'],  // $user, $amount
            ['activity.user.coupon' => 'Activity@usedCoupon'],  // $coupon, $user

            ['activity.user.editprofile' => 'Activity@userEditProfile'],  // $user
            ['activity.user.facebook' => 'Activity@linkFacebook'],  // $user
            ['activity.user.twitter' => 'Activity@linkTwitter'],  // $user
            ['activity.user.invite' => 'Activity@invitedEmail'],  // $user, $email
            ['activity.user.package.used' => 'Activity@packageUsed'],  //   $user, $userpackage, $package,  $session   √
            ['activity.user.cart.completed' => 'Activity@userCartCompleted'],  // $user, $cart, $transaction  √
            ['activity.user.reviewed.class' => 'Activity@usedReviewedClass'],  // $user, $class
             */
            event('class.created', [$class, $user]);


            die('done');
        }
    ]
);

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
        Route::post('/users-store', ['as' => 'users.store', 'uses' => 'ajax\UsersController@store']);
        Route::post('/users-update', ['as' => 'users.update', 'uses' => 'ajax\UsersController@update']);
        Route::post('/trainers/store', ['as' => 'trainers.store', 'uses' => 'ajax\TrainersController@store']);

        // Location
        Route::post('/users/getLocation',
            ['as' => 'users.location.get', 'uses' => 'ajax\UsersController@getLocation']);
        Route::post('/users/setLocation',
            ['as' => 'users.location.set', 'uses' => 'ajax\UsersController@setLocation']);

        // login
        Route::post('/auth/login', ['as' => 'auth.login.post', 'uses' => 'ajax\AuthController@postLogin']);

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

        Route::post('/sessions/getparticipants',
            ['as' => 'sessions.get.participants', 'uses' => 'ajax\SessionsController@getParticipants']);


        // venue
        Route::post('venues/store', ['as' => 'venue.store', 'uses' => 'ajax\VenuesController@store']);

        // evercise groups
        Route::post('evercisegroups',
            ['as' => 'evercisegroups.store', 'before' => 'trainer', 'uses' => 'ajax\EvercisegroupsController@store']);
        Route::post('publish',
            ['as'     => 'evercisegroups.publish',
             'before' => 'trainer',
             'uses'   => 'ajax\EvercisegroupsController@publish'
            ]);
        // uploads
        Route::post('upload/cover', ['as' => 'ajax.upload.cover', 'uses' => 'ajax\UploadController@uploadCover']);
        Route::post('upload/profile',
            ['as' => 'ajax.upload.profile', 'uses' => 'ajax\UploadController@uploadProfilePicture']);

        //Gallery
        Route::post('gallery/getDefaults',
            ['as' => 'ajax.gallery.getdefaults', 'uses' => 'ajax\GalleryController@getDefaults']);

        //Ratings
        Route::post('ratings/store', ['as' => 'ratings.store', 'uses' => 'ajax\RatingsController@store']);

    });

    /* Show home page */
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showWelcome']);

// auth / login

    Route::get(
        'auth/login/{redirect_after_login_url}',
        [
            'as' => 'auth.login.redirect_after_login',
            function ($redirect_after_login_url) {
                return View::make('auth.login')->with('redirect_after_login', TRUE)->with(
                    'redirect_after_login_url',
                    $redirect_after_login_url
                );
            }
        ]
    );
    Route::get(
        'auth/login',
        [
            'as' => 'auth.login',
            function () {
                return View::make('auth.login')->with('redirect_after_login', FALSE)->with(
                    'redirect_after_login_url',
                    FALSE
                );
            }
        ]
    );


    /*Route::get('login/fb/{redirect?}', ['as' => 'users.fb', function($redirect)
    {
       return $redirect;
    }]);*/
    Route::get('login/fb/{redirect?}', ['as' => 'users.fb', 'uses' => 'UsersController@fb_login']);
    Route::post('auth/checkout', ['as' => 'auth.checkout', 'uses' => 'SessionsController@checkout']);


    Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'auth\AuthController@getLogout']);
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

    Route::get('/profile/{id}/{tab?}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);


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
    Route::get(
        '/users/{display_name}/changepassword',
        ['as' => 'users.changepassword', 'uses' => 'UsersController@getChangePassword']
    );
    Route::post(
        '/users/changepassword',
        ['as' => 'users.changepassword.post', 'uses' => 'UsersController@postChangePassword']
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
        'evercisegroups/create',
        ['as' => 'evercisegroups.create', 'before' => 'trainer', 'uses' => 'EvercisegroupsController@create']
    );

    Route::get('/class/{id}/{preview?}', ['as' => 'evercisegroups.show', 'uses' => 'EvercisegroupsController@show']);
    Route::delete(
        '/evercisegroups/{id}',
        ['as' => 'evercisegroups.destroy', 'uses' => 'EvercisegroupsController@destroy']
    );

    Route::get(
        '/evercisegroups/clone_evercisegroups/{id}',
        ['as' => 'evercisegroups.clone_evercisegroups', 'uses' => 'EvercisegroupsController@cloneEG']
    );
    Route::post(
        '/evercisegroups/delete/{id}',
        ['as' => 'evercisegroups.delete', 'uses' => 'EvercisegroupsController@deleteEG']
    );


//Redirect All UK segments to the same function and we will go from there
    Route::any('/uk/{allsegments}', ['as' => 'search.parse', 'uses' => 'SearchController@parseUrl'])->where(
        'allsegments',
        '(.*)?'
    );
    Route::any('/uk/', ['as' => 'evercisegroups.search', 'uses' => 'SearchController@parseUrl']);


// VenuesController
    Route::get('venues', 'VenuesController@index');
    Route::get('venues/create', 'VenuesController@create');
    Route::get('venues/edit/{id}', 'VenuesController@edit');
    Route::post('venues/update/{id}', 'VenuesController@update');


// Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('checkout',
            ['as' => 'cart.checkout', 'uses' => 'CartController@checkout']);
        Route::get('confirm',
            ['as' => 'cart.confirm', 'uses' => 'CartController@confirm']);
        Route::get('payment.error',
            ['as' => 'payment.error', 'uses' => 'CartController@paymentError']);
        Route::get('cartrow', [
            'as' => 'cart.row',
            function () {
                return View::make('v3.cart.cartrow');
            }
        ]);
    });


// sessions

    Route::get(
        'sessions/{evercisegroup_id}/index',
        ['as' => 'evercisegroups.trainer_show', 'uses' => 'SessionsController@index']
    );
    Route::get('sessions/add/{id}', ['as' => 'sessions.add', 'uses' => 'SessionsController@create']);
    Route::get('sessions/date_list', ['as' => 'sessions.date_list']);
    Route::post('sessions/join', ['as' => 'sessions.join', 'uses' => 'SessionsController@joinSessions']);
    Route::get('sessions/join/class', ['as' => 'sessions.join.get', 'uses' => 'SessionsController@joinSessions']);
    Route::get('/sessions/{id}', ['as' => 'sessions.show', 'uses' => 'SessionsController@show']);
    Route::get(
        '/sessions/{sessionId}/leave',
        ['as' => 'sessions.leave', 'uses' => 'SessionsController@getLeaveSession']
    );
    Route::post(
        '/sessions/{sessionId}/leave',
        ['as' => 'sessions.leave.post', 'uses' => 'SessionsController@postLeaveSession']
    );

    /* New Stripe payment */
    Route::post('stripe/sessions',
        ['as' => 'stripe.sessions', 'uses' => 'PaymentController@processStripePaymentSessions']);
    Route::post('stripe/topup', ['as' => 'stripe.topup', 'uses' => 'PaymentController@processStripePaymentTopup']);
    Route::get('payment_confirmation',
        ['as' => 'payment_confirmation', 'uses' => 'PaymentController@sessionConfirmation']);
    Route::get('topup_confirmation', ['as' => 'topup_confirmation', 'uses' => 'PaymentController@topupConfirmation']);
    Route::get('topup', ['as' => 'topup', 'uses' => 'PaymentController@topup']);
    /* ------------------ */

// payment (old)
    Route::get(
        'sessions/{evercisegroupId}/paywithstripe',
        ['as' => 'sessions.pay.stripe', 'uses' => 'SessionsController@payForSessionsStripe']
    );

    Route::post(
        'wallets/{userId}/update_paypal',
        ['as' => 'wallets.updatepaypal', 'uses' => 'WalletsController@updatePaypal']
    );
    Route::post(
        '/sessions/{evercisegroupId}/redeemEvercoins',
        ['as' => 'sessions.redeemEvercoins.post', 'uses' => 'SessionsController@redeemEvercoins']
    );
    Route::get(
        '/sessions/{evercisegroupId}/paywithevercoins',
        function ($evercisegroupId) {
            return Redirect::to('evercisegroups/' . $evercisegroupId);
        }
    );
    Route::post(
        '/sessions/{evercisegroupId}/paywithevercoins',
        ['as' => 'sessions.paywithevercoins.post', 'uses' => 'SessionsController@postPayWithEvercoins']
    );
    Route::get('/sessions/{sessionId}/refund', ['as' => 'sessions.refund', 'uses' => 'SessionsController@getRefund']);
    Route::post(
        '/sessions/{sessionId}/refund',
        ['as' => 'sessions.refund.post', 'uses' => 'SessionsController@postRefund']
    );

// mail
    Route::get('/sessions/{id}/mail_all', ['as' => 'sessions.mail_all', 'uses' => 'SessionsController@getMailAll']);
    Route::post(
        '/sessions/{id}/mail_all',
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

    Route::get('/packages', ['as' => 'packages', 'uses' => 'PackagesController@index']);


// widgets
    Route::get('/widgets/upload', ['as' => 'widgets.upload', 'uses' => 'widgets\ImageController@getUploadForm']);
    Route::post('/widgets/upload', ['as' => 'widgets.upload.post', 'uses' => 'widgets\ImageController@postUpload']);
    Route::get('/widgets/crop', ['as' => 'widgets.crop', 'uses' => 'widgets\ImageController@getCrop']);
    Route::post('/widgets/crop', ['as' => 'widgets.crop.post', 'uses' => 'widgets\ImageController@postCrop']);
    Route::get('/widgets/map', ['as' => 'widgets.map', 'uses' => 'widgets\LocationController@getMap']);
    Route::get('/widgets/mapForm', ['as' => 'widgets.map-form', 'uses' => 'widgets\LocationController@getGeo']);
    Route::post('/widgets/postGeo', ['as' => 'widgets.postGeo', 'uses' => 'widgets\LocationController@postGeo']);
    Route::get('/widgets/calendar', ['as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@getCalendar']);
    Route::post(
        '/widgets/calendar',
        ['as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@postCalendar']
    );

// layouts and static pages
    Route::get('blog', ['as' => 'blog', 'uses' => 'PagesController@showBlog']);


    Route::get('about', ['as' => 'static.about', 'uses' => 'StaticController@show']);
    Route::get('terms_of_use', ['as' => 'static.terms_of_use', 'uses' => 'StaticController@show']);
    Route::get('privacy', ['as' => 'static.privacy', 'uses' => 'StaticController@show']);
    Route::get('the_team', ['as' => 'static.the_team', 'uses' => 'StaticController@show']);
    Route::get('faq', ['as' => 'static.faq', 'uses' => 'StaticController@show']);
    Route::get('class_guidelines', ['as' => 'static.class_guidelines', 'uses' => 'StaticController@show']);
    Route::get('contact_us', ['as' => 'static.contact_us', 'uses' => 'StaticController@show']);
    Route::get('how_it_works', ['as' => 'static.how_it_works', 'uses' => 'StaticController@show']);
    Route::get('test', ['as' => 'static.test', 'uses' => 'StaticController@show']);
    Route::post('/postPdf', ['as' => 'postPdf', 'uses' => 'PdfController@postPdf']);
    Route::get('video/create', ['as' => 'video', 'uses' => 'VideoController@create']);

// marketing
    Route::get('refer_a_friend/{code}', ['as' => 'referral', 'uses' => 'ReferralsController@submitCode']);
    Route::get('ppc/{category}/{code}', ['as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc']);
    Route::get('ppc_fb/{category}', ['as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc']);

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

    $pagesController = App::make('PagesController');
    $pagesController->generateRoutes();


// working on

    Route::get('refer_a_friend/{code}', ['as' => 'referral', 'uses' => 'ReferralsController@submitCode']);
    Route::get('ppc/{category}/{code}', ['as' => 'landing.category.code', 'uses' => 'LandingsController@submitPpc']);
    Route::get('ppc_fb/{category}', ['as' => 'ppc_fb.category', 'uses' => 'LandingsController@facebookPpc']);


    $landings = ['dance', 'pilates', 'martialarts', 'yoga', 'bootcamp', 'personaltrainer'];

    foreach ($landings as $land) {
        Route::get($land, [
            'as'   => 'landing.bootcamp',
            'uses' => function () use ($land) {
                return (new LandingsController)->landCategory($land);
            }
        ]);
    }


// layout page

    Route::get('/layouts', function () {
        return View::make('layouts.layouts');
    });


// -------------  ADMIN SECTION ---------------
    Route::get('/admin/', ['as' => 'admin.page', 'uses' => 'AdminController@dashboard']);
    Route::get('/admin/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);
    Route::get('/admin/', ['as' => 'users.create', 'uses' => 'AdminController@dashboard']);

    Route::group(['prefix' => 'ajax/admin', 'before' => 'admin'], function () {

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


        Route::post('featureClass',
            ['as' => 'admin.ajax.featureClass', 'uses' => 'AdminAjaxController@featureClass']);
        Route::post('sliderUpload',
            ['as' => 'admin.ajax.slider_upload', 'uses' => 'AdminAjaxController@sliderUpload']);
        Route::post('sliderStatus',
            ['as' => 'admin.ajax.sliderStatus', 'uses' => 'AdminAjaxController@sliderStatus']);


    });


    Route::get('/iggy_login', function () {
        Sentry::logout();
        $user = Sentry::findUserById(323);
        Sentry::login($user);

        return Redirect::route('admin.dashboard');
    });
    Route::get('/tris_login', function () {
        Sentry::logout();
        $user = Sentry::findUserById(169);
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
        }


    );

    Route::get('newvenue', function () {
        $venue = Venue::validateAndStore([
            'venue_name' => 'name2',
            'street'     => 'street2',
            'city'       => 'city2',
            'postcode'   => 'postcode2'
        ], '169');

        return var_dump($venue);
    });
    Route::get('updatevenue/{id}', function ($id) {
        $venue = Venue::find($id)->validateAndUpdate([
            'venue_name'       => 'edited1',
            'street'           => 'edited1',
            'city'             => 'edited1',
            'postcode'         => 'edited1',
            'facilities_array' => ['4', '5']
        ]);

        return var_dump($venue);
    });

    Route::get('updategroup/{id}', function ($id) {
        $result = Evercisegroup::find($id)->validateAndUpdate([
            'class_name'        => 'Running or something',
            'venue_select'      => '28',
            'class_description' => 'changed2 changed1 changed1 changed1 changed1 changed1 changed1 changed1 changed1 changed1updategroupupdategroup ',
            'image'             => 'changed1',
            'category_array'    => ['1', '2'],
        ], Sentry::getUser());

        return var_dump($result);
    });

    Route::get('creategroup', function () {
        $result = Evercisegroup::validateAndStore([
            'class_name'        => 'Fancy shit',
            'venue_select'      => '28',
            'class_description' => 'new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one new one ',
            'image'             => 'image.jpg',
            'category_array'    => ['4'],
        ], Sentry::getUser());

        return var_dump($result);
    });

    Route::get('show_amenities/{venueId}', function ($id) {
            return Venue::find($id)->getAmenities($id);
        }
    );
    Route::get('show_facilities/{venueId}', function ($id) {
            return Venue::find($id)->getFacilities($id);
        }
    );


    Route::get('paytest', function () {
            $pc = new PaymentController;

            return $pc->paid('bollocks', 'more bollocks', 'paytest');
            //return 'yeah';
        }
    );
    Route::get('conftest', ['uses' => 'PaymentController@conftest']);