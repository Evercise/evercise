<?php

$testing = true;

return array(
	'api_key' => ( $testing ? getenv('STRIPE_API_KEY_TEST') : getenv('STRIPE_API_KEY') ),

	'publishable_key' => ( $testing ? getenv('STRIPE_PUB_KEY_TEST') : getenv('STRIPE_PUB_KEY') )
);
