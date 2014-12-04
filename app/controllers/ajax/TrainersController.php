<?php namespace ajax;

use User, UserHelper, Session, Input, Config, Sentry, Event, Response, Trainer, Wallet;

class TrainersController extends AjaxBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $valid_trainer = Trainer::validTrainerSignup(Input::all());

        if ($valid_trainer['validation_failed'] == 0) {

            $image = Input::get('image');
            $website = Input::get('website');
            $profession = Input::get('profession');
            $bio = Input::get('bio');


            $trainer = Trainer::createOrFail(['user_id'    => $this->user->id,
                                              'bio'        => $bio,
                                              'website'    => $website,
                                              'profession' => $profession
                ]);

            // Duck out if record already exists
            if (!$trainer) {
                return Response::json(['result' => 'User is already a Trainer']);
            }

            // Should have already been made by user.create, but leave this to catch old accounts.
            Wallet::createIfDoesntExist($this->user->id);

            // update user image

            $this->user->image = $image;
            $this->user->save();

            // add to trainer group

            $userGroup = Sentry::findGroupById(3);
            $this->user->addGroup($userGroup);

            event('trainer.registered', [$this->user]);

            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url'      => route('users.edit', $this->user->id)
                ]
            );
        } else {
            return Response::json($valid_trainer);
        }

    }
} 