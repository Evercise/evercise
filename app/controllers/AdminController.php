<?php


/**
 * Class AdminController
 */
class AdminController extends \BaseController {


	/**
	 * show all pending trainers.
	 *
	 * @return Response
	 */
	public function pendingTrainers()
	{
        return View::make('admin.pendingtrainers')
			->with('trainers', Trainer::getUnconfirmedTrainers());
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

        return Redirect::route('admin.page', ['pendingtrainers']);
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

		return Redirect::route('admin.page', ['pendingwithdrawals']);

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

	    return Redirect::to('admin/log');
	}

    /**
     * @return \Illuminate\View\View
     */
    public function showGroups()
	{
		$evercisegroups = Evercisegroup::with('subcategories')->with('featuredClasses')->get();
		
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

    /**
     * @return \Illuminate\View\View|string
     */
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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

    public function yukon($page = 'dashboard')
    {
		//$users = User::with('evercisegroups')->where('display_name', 'LIKE', 'Peter_ATP')->get();
		//return $page;
		//return $users;

		$unconfirmedTrainers = Trainer::getUnconfirmedTrainers();
		$pendingWithdrawals = Withdrawalrequest::getPendingWithdrawals();

        return View::make('admin.yukonhtml.index')
            ->with('admin_version', '1.0')
            ->with('sPage', '1')
			->with('unconfirmedTrainers', $unconfirmedTrainers)
			->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('includePage', View::make('admin.'.$page));

    }

	public function logInAs()
	{
		$user = Sentry::findUserById(Input::get('user_id'));
		Sentry::login($user);

		return Redirect::route('users.edit');
	}

	public function resetPassword()
	{
		$user = Sentry::findUserById(Input::get('user_id'));

		$reset_code = $user->getResetPasswordCode();
		$user->sendForgotPasswordEmail($reset_code);
		//$newPassword = $user->resetPassword();

		return Response::json(['callback' => 'adminPopupMessage', 'message' => 'Password reset.  Email:'.$user->email]);
	}

	public function searchUsers()
	{
		$searchTerm = Input::get('search');
		$sentryUsers = Sentry::findAllUsers();

		$users = User::with('evercisegroups')->where('display_name', 'like', $searchTerm);

		return View::make('admin.users')
			->with('users', $users)
			->with('sentryUsers', $sentryUsers);
	}

	public function editSubcategories()
	{
		$categoryChanges = Input::get('update_categories');
		$assNumbers = explode(',', Input::get('update_associations'));

		$associations = [];

		foreach($assNumbers as $assId)
		{
			array_push($associations, [$assId => Input::get('associations_' . $assId)]);
		}


		Subcategory::editSubcategoryCategories($categoryChanges);
		Subcategory::editAssociations($associations);

		//return Response::json(['callback' => 'adminPopupMessage', 'message' => count($associations).' : '.Input::get('associations_'.'3')]);
		return Response::json(['callback' => 'successAndRefresh']);

	}

	public function addSubcategory()
	{
		$newCategoryName = Input::get('new_subcategory');

		Subcategory::create(['name' => $newCategoryName]);

		return Response::json(['callback' => 'successAndRefresh']);

	}

	public function unapproveTrainer()
	{
		$user = Sentry::findUserById(Input::get('user_id'));

		Trainer::unapprove($user);

		return Response::json(['callback' => 'successAndRefresh']);

	}

	public function editGroupSubcats()
	{
		$groupIds = explode(',', Input::get('update_categories'));

		$groupSubcats = [];

		foreach($groupIds as $groupId)
		{
			array_push($groupSubcats, [$groupId => Input::get('categories_' . $groupId)]);
			if($eg = Evercisegroup::find($groupId))
				$eg->adminMakeClassFeatured( Input::get('featured_'.$groupId) );
		}
		Evercisegroup::editSubcats($groupSubcats);


		return Response::json(['callback' => 'successAndRefresh']);
		//return Response::json(['callback' => 'adminPopupMessage', 'message' => 'done']);
	}
}