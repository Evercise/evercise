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

        return Redirect::route('admin.yukon.page', ['pendingtrainers']);
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

		return Redirect::route('admin.yukon.page', ['pendingwithdrawals']);

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


    public function editClasses($id)
    {
        $evercisegroup = Evercisegroup::find($id);
        $categories = [];
        if (Input::get('category1') != '') array_push($categories, Input::get('category1'));
        if (Input::get('category2') != '') array_push($categories, Input::get('category2'));
        if (Input::get('category3') != '') array_push($categories, Input::get('category3'));

        Evercisegroup::adminAddSubcategories($categories, $evercisegroup);


        Evercisegroup::adminMakeClassFeatured($id, Input::get('featured'));

        return Redirect::route('admin.groups');

    }

    public function yukon($page)
    {
		//$users = User::with('evercisegroups')->where('display_name', 'LIKE', 'Peter_ATP')->get();

		//return $users;

        return View::make('admin.yukonhtml.index')
            ->with('admin_version', '1.0')
            ->with('sPage', '1')
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

		foreach(explode('-', $categoryChanges) as $change)
		{
			$ch = explode('=', $change);
			if (count($ch) > 1) {
				$subcat = $ch[0];

				$subcategory = Subcategory::find($subcat);
				$subcategory->categories()->detach();

				$catArray = [];
				foreach (explode('_', $ch[1]) as $cat) {
					if ( ! in_array($cat, $catArray))
						array_push($catArray, $cat);
				}
				$subcategory->categories()->attach($catArray);
			}
		}

		return Redirect::route('admin.yukon.page', ['subcategories']);

	}
}