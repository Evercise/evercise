<?php



if (App::environment('local'))
{
	    // The environment is local
	return array(
		'CONSUMER_KEY'    => 'nalV8BT8Dsjykl8hxYcez6Gn8',
		'CONSUMER_SECRET' => 'CDiZAeENA2zujRLorr341YUQ00vcm61SMGfKUoHTW00qPB8EQW'
	);
}
elseif (App::environment('staging'))
{
	    // The environment is donkey
	return array(
		'CONSUMER_KEY'    => 'nalV8BT8Dsjykl8hxYcez6Gn8',
		'CONSUMER_SECRET' => 'CDiZAeENA2zujRLorr341YUQ00vcm61SMGfKUoHTW00qPB8EQW'
	);
}
elseif (App::environment('production'))
{
	    // The environment is VS10319
	return array(
		'CONSUMER_KEY'    => 'NkeYK4RrS97gtZNVfTfzc16hO',
		'CONSUMER_SECRET' => 'SVkoE8aSeJP50xNTb3yS1a5nL51sHyAW3XuYB7HHu2aL12vvyR'
	);
}
