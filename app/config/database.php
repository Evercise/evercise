<?php

	return array(

		'fetch' => PDO::FETCH_CLASS,

		'default' => 'mysql',

		'connections' => array(

			'sqlite' => array(
				'driver'   => 'sqlite',
				'database' => __DIR__.'/../database/production.sqlite',
				'prefix'   => '',
			),

			'mysql' => array(
				'driver'    => 'mysql',
				'host'      => 'http://london-evercise.c9va6rttuzwm.us-west-2.rds.amazonaws.com:3306',
				'database'  => 'everciseDB',
				'username'  => 'evercise_db',
				'password'  => 'FlQZnB7823',
				'charset'   => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'    => '',
			),
			
			'mysql_import' => array(
				'driver'    => 'mysql',
				'host'      => '127.0.0.1',
				'database'  => 'EverciseDB_beta_1_4',
				'username'  => '',
				'password'  => '',
				'charset'   => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'    => '',
			),

			'pgsql' => array(
				'driver'   => 'pgsql',
				'host'     => 'localhost',
				'database' => 'database',
				'username' => 'root',
				'password' => '',
				'charset'  => 'utf8',
				'prefix'   => '',
				'schema'   => 'public',
			),

			'sqlsrv' => array(
				'driver'   => 'sqlsrv',
				'host'     => 'localhost',
				'database' => 'database',
				'username' => 'root',
				'password' => '',
				'prefix'   => '',
			),

		),

		'migrations' => 'migrations',

		'redis' => array(

			'cluster' => false,

			'default' => array(
				'host'     => '127.0.0.1',
				'port'     => 6379,
				'database' => 0,
			),

		),

	);
