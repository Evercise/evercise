<?php

class AdminController extends \BaseController {

	/**
	 * show all pending trainers.
	 *
	 * @return Response
	 */
	public function pendingTrainers()
	{
		$adminGroup = Sentry::findGroupByName('admin');

		if ($this->user->inGroup($adminGroup)) {

			$trainers=Trainer::with('user')->where('confirmed', 0)->get();

			return View::make('admin.pendingtrainers')
					->with('trainers', $trainers);
		}else{
			return Redirect::route('home')->with('notification', 'you do not the correct priilages to view this page'); 
		}
		
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

	
}