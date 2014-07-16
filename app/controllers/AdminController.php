<?php

class AdminController extends \BaseController {

	/**
	 * show all pending trainers.
	 *
	 * @return Response
	 */
	public function pendingTrainers()
	{


		$trainers=Trainer::with('user')->where('confirmed', 0)->get();

		return View::make('admin.pendingtrainers')
			->with('trainers', $trainers);

		
	}

	/**
	 * Approve trainers.
	 *
	 * @return Response
	 */
	public function approveTrainer()
	{
		$trainer_id = Input::get('trainer');

		try{
			$trainer= Trainer::find($trainer_id);

			$trainer->confirmed = 1;

			$trainer->save();

			return Redirect::route('admin.pending');
		}
		catch(Exception $e)
		{
			return $e;
		}

		
	}

	public function pendingWithdrawal()
	{
		$pendingWithdrawals = Withdrawalrequest::where('processed', 0)->with('user')->get();

		$processedWithdrawals = Withdrawalrequest::where('processed', 1)->with('user')->get();

		return View::make('admin.pendingwithdrawals')
			->with('pendingWithdrawals', $pendingWithdrawals)
			->with('processedWithdrawals', $processedWithdrawals);
	}

	public function processWithdrawal()
	{
		$withdrawal_id = Input::get('withdrawal_id');

		Withdrawalrequest::find($withdrawal_id)->markProcessed();

		return Redirect::route('admin.pending_withdrawal');

	}

	
}