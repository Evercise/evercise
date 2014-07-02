<?php
// app/config/facebook.php
 
// Facebook app Config 

if (App::environment('local'))
{
	    // The environment is local
	return array(
	        'appId' => '492492450851682',
	        'secret' => 'b5f9e533949178ebe7c33936c81ad833'
	    );
}
elseif (App::environment('staging'))
{
	    // The environment is donkey
	return array(
	        'appId' => '247621532113217', // donkey
	        'secret' => '762e0e54c435804033d7ece1d4b50122' // donkey
	    );
}
elseif (App::environment('production'))
{
	    // The environment is VS10319
	return array(
	        'appId' => '425004847609443', // VS10319
	        'secret' => 'cef796862987836c8bb175e4304de6da' // VS10319
	    );
}