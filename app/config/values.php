<?php

return array(

	// count - How many to count to before a reward is given
	// reward - Amount rewarded in pounds
	// Recur - Number of times the award can be claimed 
	'milestones' => [
		'referral' => 	['count'=>3, 'reward'=>5, 'recur'=>2,  'column'=>'referrals'],
		'profile' => 	['count'=>1, 'reward'=>1, 'recur'=>1,  'column'=>'profile'],
		'facebook' => 	['count'=>1, 'reward'=>1, 'recur'=>1,  'column'=>'facebook'],
		'twitter' => 	['count'=>1, 'reward'=>1, 'recur'=>1,  'column'=>'twitter'],
		'review' => 	['count'=>5, 'reward'=>5, 'recur'=>10, 'column'=>'reviews'],
	],

	// Amount rewarded for signing up from a referral link in pounds
	'freeCoins' => [
		'referral_signup' => 1,
	],
	
	// Value of an evercoin in pounds
	'evercoin' => 0.01,

);