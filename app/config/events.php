<?php

/*
 * Configuration for Event Listeners and Triggers
 *
 * The logic is:
 *
 * [
 *      'PRIORITY' => [EVENT NAME => EVENT FUNCTION UNDER THE events Namespace]
 * ]
 *
return [

    '0'  => [
        ['user.signup' => 'whenUserSignsUp']
    ],
    '5'  => [
        ['user.signup.something' => 'whenUserSignsUp']
    ],
    '10' => [
        ['user.signup.somethingOLSE' => 'whenUserSignsUp']
    ]
];

 */


return [

    '0'  => [
        ['user.registered' => 'User@hasRegistered'],
        ['user.registered' => 'Tracking@userRegistered'],
    ]
];