<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// php artisan check:sessions

class SalesForce extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'salesforce';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Copies key tables from the main DB to the salesforce DB';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		// This doesn't work - come back to it later

/*		if (! DB::connection('salesforce')->hasTable('users'))
		{
			DB::connection('salesforce')->create('users', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('email');
				$table->string('first_name');
				$table->string('last_name');
				$table->string('display_name', 45);
				$table->tinyInteger('gender');
				$table->date('dob');
				$table->string('area_code', 20);
				$table->string('phone', 20);
			});
		}
		else
		{
			DB::connection('salesforce')->table('users')->truncate();
		}*/
		

		$users = User::all()->toArray();
		//$this->info(var_dump($users[0]->email));
		foreach ($users as $user) {
		    
/*	    DB::connection('salesforce')->table('users')->insert([
	    	'id'=>$user['id'],
	    	'email'=>$user['email'],
	    	'first_name'=>$user['first_name'],
	    	'last_name'=>$user['last_name'],
	    	'display_name'=>$user['display_name'],
	    	'gender'=>$user['gender'],
	    	'dob'=>$user['dob'],
	    	'area_code'=>$user['area_code'],
	    	'phone'=>$user['phone'],
	    ]);*/
			$this->info(var_dump($user['email']));
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('days', null, InputOption::VALUE_OPTIONAL, 'How many days to search back.', 1),
		);
	}

}
