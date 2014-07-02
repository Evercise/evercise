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

		$trainer= Trainer::find($trainer_id);

		$trainer->confirmed = 1;

		$trainer->save();

		return Redirect::route('admin.pending');
	}

	public function pendingWithdrawal()
	{
		return View::make('admin.pendingwithdrawals');
	}

	public function processWithdrawal()
	{

	}

	
}