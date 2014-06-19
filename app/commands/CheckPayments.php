<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckPayments extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'check:payments';

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
		$this->info('checking for unprocessed payments older than '.$days.' day'.($days!=1?'s':''));

		$today = new DateTime('now');
		$yesterday = (new DateTime('now'))->sub(new DateInterval('P1D'));

		$payments = Sessionpayment::where('created_at', '<',  $today)
		->where('created_at', '>',  $yesterday )
		->where('processed', 0)
		->with('user.wallet')
		->get();

		foreach ($payments as $p_key => $payment) {

			$currentBalance = $payment->user->wallet->balance;
			$newBalance = $currentBalance + $payment->total_after_fees;

			$this->info('payment id: '.$payment->total.'  : '.$currentBalance.' : '.$newBalance);
			Wallet::where('id', $payment->user->wallet->id)->update(['balance'=>$newBalance]);

			$payment->update(['processed'=>1]);
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
