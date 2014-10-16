<?php namespace composers;

use User;
use Sentry;
use Input;

class AdminShowUsersComposer {

    public function compose($view)
    {
        $sentryUsers = Sentry::findAllUsers();

        $searchTerm = Input::get('search');
        $users = User::with('evercisegroups')->where('display_name', 'LIKE', '%'.$searchTerm.'%')->whereHas('trainer', function($q){
            //$q->where('confirmed', 1);
        })->get();

        $view
            ->with('users', $users)
            ->with('sentryUsers', $sentryUsers);
    }
}