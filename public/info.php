<?php

if (isset($SERVER['HTTPS']))
{
		echo "on";
		var_dump($SERVER['HTTPS']);
}else{
	echo "no";
}
phpinfo();
?>