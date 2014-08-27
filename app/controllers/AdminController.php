<?php


class AdminController extends \BaseController {


    /**
	 * show all pending trainers.
	 *
	 * @return Response
	 */
	public function pendingTrainers()
	{
        return View::make('admin.pendingtrainers')
			->with('trainers', Trainer::getConfirmedTrainers());
	}

	/**
	 * Approve trainers.
	 *
	 * @return Response
	 */
	public function approveTrainer()
	{
        $user = User::getUserByTrainerId(Input::get('trainer'));

        Trainer::approve($user);

        return Redirect::route('admin.pending');
	}

    /**
     * @return \Illuminate\View\View
     */
    public function pendingWithdrawal()
	{
		$pendingWithdrawals = Withdrawalrequest::where('processed', 0)->with('user')->get();

		$processedWithdrawals = Withdrawalrequest::where('processed', 1)->with('user')->get();

		return View::make('admin.pendingwithdrawals')
			->with('pendingWithdrawals', $pendingWithdrawals)
			->with('processedWithdrawals', $processedWithdrawals);
	}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processWithdrawal()
	{
		$withdrawal_id = Input::get('withdrawal_id');

		Withdrawalrequest::find($withdrawal_id)->markProcessed();

		return Redirect::route('admin.pending_withdrawal');

	}

    /**
     * @return \Illuminate\View\View
     */
    public function showLog()
	{
	    $logFile = file_get_contents('../app/storage/logs/laravel.log', true);

	    $logFile = str_replace('[] []', '[] []<br><br><br>', $logFile);
	    $logFile = str_replace('#', '<br><span style="color:red;">#</span>', $logFile);

	    return View::make('admin.log')
	    ->with('log', $logFile);
	}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLog()
	{
		$del = Input::get('del');

		if($del == 'delete_all')
			file_put_contents('../app/storage/logs/laravel.log', '');

	    return Redirect::route('admin.log');
	}

    /**
     * @return \Illuminate\View\View
     */
    public function showGroups()
	{
		$evercisegroups = Evercisegroup::with('subcategories')->get();
		
	    return View::make('admin.groups')
            ->with('evercisegroups', $evercisegroups);
	}

    /**
     * TODO - make this function (add categories to groups)
     *
     * @return \Illuminate\View\View
     */
    public function addGroup()
	{
	    return View::make('admin.groups');
	}

	public function showGroupRatings()
	{
		
		$fakeusers = Sentry::findGroupById(6);
		$fakeuserLoggedIn = $this->user ? $this->user->inGroup($fakeusers) : false;

		if(!$fakeuserLoggedIn) return 'please log in with a fake user';

		$evercisegroups = Evercisegroup::whereHas('futuresessions', function($query){
			$query->with('ratings');
			$query->with('fakeRatings');
		})->get();
		
	    return View::make('admin.fakeratings')
	    ->with('evercisegroups', $evercisegroups);
	}

	public function addRating()
	{
        $result = FakeRating::validateAndCreateRating();

        if ($result['validation_failed']) {
            return Response::json($result);
        }
        else{
            return Response::json(['callback' => 'successAndRefresh']);
        }

	}

	public function showUsers()
	{
			$sentryUsers = Sentry::findAllUsers();

			$users = User::with('evercisegroups')->get();
		
	    return View::make('admin.users')
	    ->with('users', $users)
	    ->with('sentryUsers', $sentryUsers);
	}


}