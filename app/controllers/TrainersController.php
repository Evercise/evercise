<?php

class TrainersController extends \BaseController
{

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
        if (!Sentry::check()) {
            return View::make('trainers.about')->with('status', 'logged-out')->with('redirect_after_login', TRUE);
        }

        //$user = Sentry::getUser();
        $trainerGroup = Sentry::findGroupByName('trainer');
        if ($this->user->inGroup($trainerGroup)) {
            return Redirect::route('trainers.edit', $this->user->id);
        }

        $specialities = Speciality::all();
        $disciplines = [];
        $titles = [];
        foreach ($specialities as $sp) {
            if (!isset($titles[$sp->name])) {
                $disciplines[$sp->name] = $sp->name;
                $titles[$sp->name] = [$sp->titles];
            } else {
                array_push($titles[$sp->name], $sp->titles);
            }
        }

        // http://image.intervention.io/methods/crop
        // http://odyniec.net/projects/imgareaselect

        return View::make('v3.trainers.create')
            ->with('disciplines', $disciplines);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id, $tab = 0)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if ($id == 'me') {
            $user = Sentry::getUser();
            $id = $user->id;
        } else {
            $user = User::where((is_numeric($id) ? 'id' : 'display_name'), $id)->first();

        }

        $trainer = $user->trainer()->first();


        // check if trainer has classes else redirect them home
        try {
            $evercisegroups = Evercisegroup::has('futuresessions')
                ->with('futuresessions')
                ->with('venue')
                ->where('user_id', $trainer->user->id)->get();
        } catch (Exception $e) {
            return Redirect::route('home')->with('notification', 'this trainer does not exist');
        }


        $stars = [];
        $totalStars = 0;
        $evercisegroup_ids = [];

        foreach ($evercisegroups as $key => $evercisegroup) {
            $evercisegroup_ids[] = $evercisegroup->id;
        }

        if (!empty($evercisegroup_ids)) {
            $ratings = Rating::with('rator')->whereIn('evercisegroup_id',
                $evercisegroup_ids)->orderBy('created_at')->get();

            foreach ($ratings as $key => $rating) {
                $stars[$rating->evercisegroup_id][] = $rating->stars;
                $totalStars = $totalStars + $rating->stars;
            }
        } else {
            $ratings = [];
        }

        $data = [
            'trainer'        => $trainer,
            'evercisegroups' => $evercisegroups,
            'stars'          => $stars,
            'totalStars'     => $totalStars,
            'ratings'        => $ratings
        ];

        return View::make('v3.trainers.show')
            ->with('data', $data)
            ->with('tab', 0);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $validator = Validator::make(
            Input::all(),
            [
                'bio'        => 'required|max:500|min:50',
                'profession' => 'required|max:50|min:5',
            ]
        );
        if ($validator->fails()) {
            if (Request::ajax()) {
                $result = [
                    'validation_failed' => 1,
                    'errors'            => $validator->errors()->toArray()
                ];

                return Response::json($result);
            } else {
                return Redirect::route('trainers.edit')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            // Actually update the trainer record

            $bio = Input::get('bio');
            $website = Input::get('website');
            $profession = Input::get('profession');

            $trainer = Trainer::find($id);

            if ($this->user->id != $trainer->user_id) {
                return Response::json(['callback' => 'fail']);
            }

            $trainer->update([
                'bio'        => $bio,
                'website'    => $website,
                'profession' => $profession,
                //'specialities_id' => $speciality->id,
            ]);

            $result = [
                'callback' => 'gotoUrl',
                'url'      => '/trainers/2/edit/trainer'
            ];

            Event::fire('trainer.editTrainerDetails', [$this->user]);

            return Response::json($result);

        }
    }
}