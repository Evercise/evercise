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
	'ppc_categories' => ['dance'=>1, 'pilates'=>1, 'martialarts'=>4, 'yoga'=>5, 'bootcamp'=>7, 'personaltrainer'=>13],
	'ppc_category_examples' => [
		1=>		'So you like to have a little music to your workouts? Look no further. We have Zumba, Salsa and many more class types available for those who want to move their muscles to a rhythmic beat.',
		2=>		'So you&apos;re into a system that focuses on improving balance by stretching? Why not check out our intense Hot Pilates sessions, or our Post-natal classes for those looking to recover',
		4=>		'Have an interest in Martial Arts? Why not punch your way through to our new range of classes, with choices from MMA to Kick-boxing. Check it out!',
		5=>		'So you&apos;re into mind and body fitness? We have a range of classes that will get your legs stretching, from Vinyasa to Pilates. Pick your choice!',
		7=>		'So you&apos;ve expressed an interest in exercising outdoors? Check out our boot camp classes all steered for those who love workouts in the fresh air!',
		13=>	'So you&apos;re into a fitness regimes or routine workouts? There are one-to-one and group classes catered for all levels of expertise.',
	],

    // dates
    'min_age' => 16,
    'max_age' => 120,

    // Refunds cut off dates (in number of days into the future)
    'half_refund_cut_off' => 2,
    'full_refund_cut_off' => 5,

    // price
    'max_price' => 120

);