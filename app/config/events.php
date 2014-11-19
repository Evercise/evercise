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
 * session.payed => User joined a class
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
 */


return [

    '0'  => [


    ],
    '10' => [
        //All Tracking is Low Priority
        ['user.registered' => 'Tracking@userRegistered'],
        ['user.registeredFacebook' => 'Tracking@userFacebookRegistered'],
        ['trainer.registered' => 'Tracking@trainerRegistered'],
        ['user.login' => 'Tracking@userLogin'],
        ['user.loginFacebook' => 'Tracking@userFacebookLogin'],
        ['user.edit' => 'Tracking@userEdit'],
        ['trainer.edit' => 'Tracking@trainerEdit'],
        ['user.changedPassword' => 'Tracking@userChangePassword'],
        ['user.admin.trainerCreate' => 'Admin@hasCreatedTrainer'],
        ['class.index.single' => 'Indexer@indexSingle'],
        ['class.index.all' => 'Indexer@indexAll']


    ]
];

