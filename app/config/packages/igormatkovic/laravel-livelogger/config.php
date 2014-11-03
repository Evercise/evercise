<?php

/*
 *  AVAILABLE log levels
 *  debug, info, notice, warning, error, critical, alert, emergency
 *
 *  Its not advised to enable on debug as the log level because it can slow the pageload
 *
 */

return array(

    'log_level'         => 'error',
    'dateformat'        => 'H:i:s',
    'pusher_app_id'    => (getenv('pusher_app_id') ?: '94726'),
    'pusher_api_key'    => (getenv('pusher_api_key') ?: '8c85719e24eccb146d79'),
    'pusher_api_secret'    => (getenv('pusher_api_secret') ?: '9ad1b1db64290ef80f2f'),
    'pusher_use_ssl'    => false
);