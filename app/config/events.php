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
 * user.registered  =>  After the User has Registered
 * ... etc
 */


return [

    '0'  => [
        ['user.registered' => 'User@hasRegistered'],
        ['user.registered' => 'Tracking@userRegistered'],
    ]
];

