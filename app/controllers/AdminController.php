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
		
		$evercisegroups = Evercisegroup::with('subcategories')->get();
		
	    return View::make('admin.groups')
	    ->with('evercisegroups', $evercisegroups);
	}

	public function addGroup()
	{
		

	    return View::make('admin.groups');
	    //->with('log', $logFile);
	}

	public function showGroupRatings()
	{
		
		$fakeusers = Sentry::findGroupById(6);
		$fakeuserLoggedIn = $this->user ? $this->user->inGroup($fakeusers) : false;

		if(!$fakeuserLoggedIn) return 'please log in with a fake user';

/*		$groupswithratings = Evercisegroup::whereHas('ratings', function(){})->lists('id');
		// Return groups with sessions in the future, which do not have any ratings
		$evercisegroups = Evercisegroup::whereHas('futuresessions', function($query) use ($groupswithratings){
			$query->whereNotIn('evercisegroup_id', $groupswithratings);
		})->get();*/

		$evercisegroups = Evercisegroup::whereHas('futuresessions', function($query){
			$query->with('ratings');
			$query->with('fakeRatings');
		})->get();
		
	    return View::make('admin.fakeratings')
	    ->with('evercisegroups', $evercisegroups);
	}

	public function addRating()
	{
			$validator = Validator::make(
				Input::all(),
				array(
					'rator' => 'required|max:5|min:1',
					'evercisegroup_id' => 'required|max:5|min:1',
					'stars' => 'required|max:1|min:1|between:0,5',
					'comment' => 'required|max:255|min:4',
				)
			);
			if($validator->fails()) {
				if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	
						return Response::json($result);
	        }else
	        {
						$evercisegroup_id = Input::get('evercisegroup_id', 1);
		        	return Redirect::route('evercisegroups.show', [$evercisegroup_id])
						->withErrors($validator)
						->withInput();
	        }
			}

			$stars = Input::get('stars', 1);
			$comment = Input::get('comment', 1);
			$evercisegroup_id = Input::get('evercisegroup_id', 1);
			$rator = Input::get('rator', 0);

			FakeRating::create([
				'user_id'=>$rator ? $rator : $this->user->id,
				'evercisegroup_id'=>$evercisegroup_id,
				'stars'=>$stars,
				'comment'=>$comment,
			]);

			return Response::json(['callback' => 'successAndRefresh']);
	}

	public function showUsers()
	{
		$users = Sentry::findAllUsers();
		
	    return View::make('admin.users')
	    ->with('users', $users);
	}
	
}