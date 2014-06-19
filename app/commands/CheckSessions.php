<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckSessions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'check:sessions';

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
	public function fire()
	{
		$days = $this->option('days');
		$this->info('checking for sessions in the last '.$days.' day'.($days!=1?'s':''));

		$today = new DateTime('now');
		$yesterday = (new DateTime('now'))->sub(new DateInterval('P1D'));

		$sessions = Evercisesession::where('date_time', '<',  $today)
		->where('date_time', '>',  $yesterday )
		->has('sessionpayment', '==', 0)
		->with('evercisegroup')
		->with('sessionmembers')
		->with('sessionpayment')
		->get();

		/*$session_ids = [];
		foreach ($sessions as $key => $session) {
			$session_ids[] = $session->id;
		}*/

		//$sessionPayments = Sessionpayment::whereNotIn($session_ids)->get();

		foreach ($sessions as $s_key => $session) {
			$this->info('session: group['.$session->evercisegroup_id.'] --> '. $session->id.' : ');
			
			$commission = 0.10;
			$total = count($session->sessionmembers) * $session->price;
			$totalAfterFees = $total * (1.00 - $commission);

			// If the session has members, and a sessionpayment has not already been created, create a sessionpayment
			if (count($session->sessionmembers) && count($session->sessionpayment)==0)
			{
				$this->info(' ...');
				foreach ($session->sessionmembers as $m_key => $member) {
					$this->info(' ...member... '. $member->user_id);
				}
	
				$payment = Sessionpayment::create([
					'user_id'=>$session->evercisegroup->user_id,
					'evercisesession_id'=>$session->id,
					'total'=>$total,
					'total_after_fees'=>$totalAfterFees,
					'commission'=>$commission,
					'processed'=>0,
				]);
			}
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
			array('days', null, InputOption::VALUE_OPTIONAL, 'How many days to search back.', 1),
		);
	}

}
