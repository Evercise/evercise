<?php

return array(

	// count - How many to count to before a reward is given
	// reward - Amount rewarded in pounds
	// Recur - Number of times the award can be claimed 
	'milestones' => [
		'referral' => 		['count'=>3,	'reward'=>5, 	'recur'=>2,  	'column'=>'referrals'	],
		'profile' => 			['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'profile'		],
		'facebook' => 		['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'facebook'	],
		'twitter' => 			['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'twitter'		],
		'review' => 			['count'=>5,	'reward'=>5, 	'recur'=>10, 	'column'=>'reviews'		],
	],

	// Amount rewarded for signing up from a referral link in pounds
	'freeCoins' => [
		'referral_signup' => 1,
		'ppc_signup' => 3,
	],
	
	// Value of an evercoin in pounds
	'evercoin' => 0.01,

	// category strings to load landing pages.  the string is accpeted from a route, and mapped to these category id's in LandingsController::loadCategory
	'ppc_categories' => ['dance'=>1, 'martialarts'=>4, 'yoga'=>5, 'bootcamp'=>7, 'personaltrainer'=>13],
	'ppc_category_examples' => [
		1=>'keen on dancing, eh?',
		4=>'Have an interest in Martial Arts? Why not punch your way through to our new range of classes, with choices from MMA to Kick-boxing. Check it out!',
		5=>'Keen on Yoga eh?',
		7=>'Keen on Bootcamps eh?',
		13=>'Keen on Personal Trainers eh?',
	],

);