<?php

/**
 * This is a Example Enviroment file
 *
 * Make a copy of this file and name it .env.php
 *
 * After your copied it just edit the contents of it to match your setup
 */
return [

    'DEBUG_APP'             => true,
    'APP_URL'               => 'http://evercise.dev/',
    'ENCRYPTION_KEY'        => 'ozt38MwirMfb5STSJWowmnHBGUz0ziAR',
    //DB LIVE
    'DB_HOST'               => 'localhost',
    'DB_NAME'               => 'evercise',
    'DB_USER'               => 'evercise',
    'DB_PASS'               => 'evercise',
    //DB MIGRATION
    'DB_V1_HOST'            => 'localhost',
    'DB_V1_NAME'            => 'evercise',
    'DB_V1_USER'            => 'evercise',
    'DB_V1_PASS'            => 'evercise',
    //EMAIL SETUP
    'EMAIL_DRIVER'          => 'smtp',
    'EMAIL_SMTP_HOST'       => 'smtp.gmail.com',
    'EMAIL_SMTP_PORT'       => 587,
    'EMAIL_FROM_ADDRESS'    => 'noreply@evercise.com',
    'EMAIL_FROM_NAME'       => 'Evercise',
    'EMAIL_SMTP_ENCRYPTION' => 'tls',
    'EMAIL_SMTP_USERNAME'   => 'contact@evercise.com',
    'EMAIL_SMTP_PASSWORD'   => 'evercise1234',
    'EMAIL_SENDMAIL'        => '/usr/sbin/sendmail -bs',
    'EMAIL_PRETEND'         => true, //For Production Set to False
    //Facebook Data
    'FACEBOOK_ID'           => '306418789525126',
    'FACEBOOK_SECRET'       => 'd599aae625444706f9335ca10ae5f71d'

];