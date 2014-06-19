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

		$cutOffDate = (new DateTime('now'))->sub(new DateInterval('P'.$days.'D'));

		$payments = Sessionpayment::where('created_at', '<',  $cutOffDate)
		->where('processed', 0)
		->with('user.wallet')
		->get();

		foreach ($payments as $p_key => $payment) {

			$currentBalance = $payment->user->wallet->balance;
			$newBalance = $currentBalance + $payment->total_after_fees;

			$this->info('processing payment. id: '.$payment->id.', total after fees: '.$payment->total_after_fees.', new balance: '.$newBalance);
			$payment->user->wallet->where('id', $payment->user->wallet->id)->update([
				'balance'=>$newBalance,
				'previous_balance'=>$currentBalance
			]);
			$payment->user->wallet->recordedSave([
				'user_id' => $payment->user_id,
				'sessionpayment_id' => $payment->id,
				'transaction_amount' => $payment->total_after_fees,
				'new_balance' => $newBalance
			]);

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
			array('days', null, InputOption::VALUE_OPTIONAL, 'How many days to search back.', 3),
		);
	}

}
