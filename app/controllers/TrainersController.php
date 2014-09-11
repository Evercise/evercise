<?php



class TrainersController extends \BaseController {
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public  function trainersEvercisegroups($id)
    {
        $evercisegroups = Evercisegroup::has('futuresessions')
            ->with('futuresessions')
            ->with('venue')
            ->with('ratings')
            ->where('user_id', $id)->get();
        return $evercisegroups;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('trainers.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return    View::make('trainers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $result = Trainer::createTrainerRecord(Input::all());

        if($result == 'saved')
        {
            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url' => route('evercisegroups.index')
                ]
            );
        }
        else
        {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $result
                ]
            );
        }

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $tab=0)
	{
		$trainer = Trainer::where('user_id' , $this->user->id)->first();

		return View::make('trainers.edit')
			->with('trainer', $trainer)
			->with('tab', $tab);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try{
            $user = Trainer::fullTrainerAsUser($id);


            $evercisegroups = self::trainersEvercisegroups($id);

            $totalStars = $user->totalRating();

            return View::make('trainers.show')
                ->with('user_trainer', $user)
                ->with('evercisegroups', $evercisegroups)
                ->with('totalStars', $totalStars);

        }catch (Exception $e){
            return Redirect::route('home')->with('notification', 'this trainer does not exist');
        }

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        $result =  Trainer::updateTrainerDetails($this->user, Input::all());

        if($result == 'saved')
        {
            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url' => route('trainers.edit.tab', [$id, 'trainer'])
                ]
            );
        }
        else
        {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $result
                ]
            );
        }
	}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trainerSignup()
	{
		Session::put('redirectAfter', 'trainer/create');

		return Redirect::to('users/create');
	}


}