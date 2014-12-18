<?php

return [
    'api_key'         => (Config::get('evercise.stripe_testing') ? Config::get('evercise.stripe_api_key_test') : Config::get('evercise.stripe_api_key_test')),
    'publishable_key' => (Config::get('evercise.stripe_testing') ? Config::get('evercise.stripe_pub_key_test') : Config::get('evercise.stripe_pub_key_test'))
];
