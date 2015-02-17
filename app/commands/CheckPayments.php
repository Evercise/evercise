<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// php artisan check:payments

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

		$cutOffDate = (new DateTime('now'))->sub(new DateInterval('P'.$days.'D'));

		$payments = Sessionpayment::where('created_at', '<',  $cutOffDate)
		->where('processed', 0)
		->with('user.wallet')
		->get();

		foreach ($payments as $p_key => $payment) {

			//$payment->user points to the user who bought the class NOT the trainer to be paid!

			$trainer = $payment->evercisesession->evercisegroup->user;

			$currentBalance = $trainer->wallet->balance;
			$newBalance = $currentBalance + $payment->total_after_fees;

			$this->info('processing payment. id: '.$payment->id.', total after fees: '.$payment->total_after_fees.', new balance: '.$newBalance);

			$trainer->wallet->find($trainer->wallet->id)->deposit($payment->total_after_fees, $payment->id, 'trainer_payment');

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
			array('days', null, InputOption::VALUE_OPTIONAL, 'How many days old records should be before processing.', 3),
		);
	}

}
