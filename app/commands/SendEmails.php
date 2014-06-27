<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendEmails extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'emails';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		// Check for sessions happening in less than 2 days
		//    Send a reminder email to all users
		//    Send a participant list to the trainer
	public function fire()
	{
		//$sessionDate = new DateTime($session->date_time);
		$twodaysago = (new DateTime())->sub(new DateInterval('P2D'));


		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$twodaysago)
		{

			//$query->where('date_time', '<', $twodaysago);
			$query->where('id', 1);

		}), 'evercisesession')->get();

		$this->info(count($evercisegroup));
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
