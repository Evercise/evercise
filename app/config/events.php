<?php

/*
 * Configuration for Event Listeners and Triggers
 *
 * The logic is:
 *
 * [
 *      'PRIORITY' => [EVENT NAME => EVENT FUNCTION UNDER THE events Namespace]
 * ]
 */

/** AVAILABLE EVENT NAMES */
/*
 * Event::fire('user.registeredFacebook', [$user]);
 *
 * user.registered  =>  After the User has Registered
 * user.registeredFacebook => After User Signs up with facebook
 * user.edit => User edited there profile
 * user.changedPassword => User has changed there password
 * user.login => User has changed there password
 * user.logout => User has changed there password
 * user.loginFacebook => User has changed there password
 * user.fullProfile => User has completed there profile
 * trainer.registered => trainer has registered
 * trainer.edit => trainer has edited there user details
 * trainer.editTrainerDetails => trainer has edited there user details
 * evecisegroup.created => trainer created a new class
 * evecisegroup.delete => trainer deleted a class
 * session.create => Trainer added a nnew session to a class
 * session.delete => Trainer removed a session
 * session.joined => User joined a class
 * session.left => User left a class
 * rating.create => User left a rating for a class
 * wallet.request => Trainer has requested a withdrawel from there wallet
 * wallet.updatePaypal => User has updated there paypal details
 *
 *
 * class.index.single => Index a Single Class
 * class.index.all => Index all Classes
 *
 * user.admin.trainerCreate => ($user, $trainer) when a admin creates a trainer
 *
 *activity.class.payed =>  $class, $user
 *activity.class.canceled  $class, $user
 *activity.class.create  $class, $user
 *activity.class.update  $class, $user
 *activity.class.delete  $class, $user
 *activity.venue.create  $venue, $user
 *activity.venue.update  $venue, $user
 *activity.venue.delete  $venue, $user

 *activity.session.create  $class, $user
 *activity.session.update  $class, $user
 *activity.session.delete  $class, $user

 *activity.wallet.topup  $user, $amount
 *activity.wallet.withdraw  $user, $amount

 *activity.user.editprofile  $user
 *activity.user.facebook  $user
 *activity.user.twitter  $user
 *activity.user.invite  $user, $email
 */


return [

    '10' => [

        ['user.registered' => 'User@hasRegistered'], // $user
        ['user.registeredFacebook' => 'User@facebookRegistered'], // $user  // ∑

        ['user.signup' => 'User@welcome'], // $user   // ∑
        ['user.guest.signup' => 'User@welcomeGuest'], // $user   // ∑
        ['user.facebook.signup' => 'User@facebookWelcome'], // $user   // ∑
        ['user.forgot.password' => 'User@facebookWelcome'], // $user   // ∑
        ['user.changedPassword' => 'User@userChangedPassword'], // $user, $link   // ∑
        ['user.upgrade' => 'User@userUpgrade'], // $user   // ∑

        ['user.login' => 'User@login'], // $user
        ['user.logout' => 'User@logout'], // $user
        ['user.loginFacebook' => 'User@facebookLogin'],
        ['user.edit' => 'User@edit'],
        ['user.cart.completed' => 'User@cartCompleted'], // $user, $cart, $transaction // ∑
        ['user.topup.completed' => 'User@topupCompleted'], // $user, $transaction // ∑
        ['trainer.registered' => 'Trainer@registered'], //$trainer
        ['trainer.edit' => 'Trainer@edit'],
        ['trainer.session.joined' => 'Trainer@sessionJoined'], // $user, $trainer, $session


        ['class.created' => 'Classes@classCreated'],  // $class, $trainer
        ['class.deleted' => 'Classes@classDeleted'],  // $class, $trainer
        ['class.updated' => 'Classes@classUpdated'],  // $class, $trainer
        ['session.joined' => 'Sessions@joinedClass'], // $user, $trainer, $session, $everciseGroup, $transactionId
        ['session.upcoming_session' => 'Sessions@upcommingSessions'],
        ['session.mail_all' => 'Sessions@mailAll'],
        ['session.mail_trainer' => 'Sessions@mailTrainer'],
        ['session.userLeft' => 'Sessions@userLeaveSession'],
        ['session.trainerLeft' => 'Sessions@trainerLeaveSession'],
        ['session.refund' => 'Sessions@refundRequest'],


        ['venue.create' => 'Classes@venueCreated'],
        ['venue.update' => 'Classes@venueUpdated'],


    ],
    '5'  => [
        ['referral.invite' => 'User@invite'], // $email, $referralCode, $referrerName // ∑
        ['landing.ppc' => 'User@ppc'] // $email, $categoryId, $ppcCode
    ],
    '0'  => [
        //All Tracking is Low Priority
        ['stats.class.counter' => 'Stats@classViewed'],
        ['class.viewed' => 'Classes@classViewed'], // $class, $user = false
        ['user.admin.trainerCreate' => 'Admin@hasCreatedTrainer'],
        ['class.index.single' => 'Indexer@indexSingle'],
        ['class.index.all' => 'Indexer@indexAll'],
        //            ['user.edit' => 'Tracking@userEdit'],
        //            ['trainer.edit' => 'Tracking@trainerEdit'],
        //            ['user.changedPassword' => 'Tracking@userChangePassword'],
        //            ['user.package.used' => 'Tracking@userChangePassword'],
        //            ['session.create' => 'Tracking@registerSessionTracking'],


        /**
         * THIS IS REALLY LOW PRIORITY
         * MOST OF THE FUNCTIONS HERE ARE ALREADY TRIGGERED BY OTHER EVENTS
         * BUT JUST IN CASE WE NEED THEM
         */


        ['activity.class.payed' => 'Activity@payedClass'],  // $class, $user
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

    ]
];


