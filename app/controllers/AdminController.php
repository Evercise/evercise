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
			$user= User::whereHas('trainer', function($query) use (&$trainer_id)
			{
				$query->where('id', $trainer_id );
			})->first();


			$trainer = Trainer::where('user_id', $user->id)->update(['confirmed' =>1]);

			Event::fire('user.upgrade', array(
            	'email' => $user->email, 
            	'display_name' => $user->display_name
            ));

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

	public function showLog()
	{
		
	    $logFile = file_get_contents('../app/storage/logs/laravel.log', true);


	    $logFile = str_replace('[] []', '[] []<br><br><br>', $logFile);
	    $logFile = str_replace('#', '<br><span style="color:red;">#</span>', $logFile);

	    return View::make('admin.log')
	    ->with('log', $logFile);
	}

	public function deleteLog()
	{
		$del = Input::get('del');

		if($del == 'delete_all')
		{
			file_put_contents('../app/storage/logs/laravel.log', '');
		}

	    return Redirect::route('admin.log');
	}

	public function showGroups()
	{
		return var_dump(stylesheet_link_tag()) ;
		
	    return View::make('admin.groups');
	    //->with('log', $logFile);
	}

	public function addGroup()
	{
		
		if($evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers')
			->with('subcategories.categories')->find($id))
		{

		}

	    return View::make('admin.groups');
	    //->with('log', $logFile);
	}
	
}