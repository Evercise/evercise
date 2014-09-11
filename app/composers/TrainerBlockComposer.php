<?php namespace composers;

use JavaScript;
use DateTime;

class TrainerBlockComposer
{

    public function compose($view)
    {
        $viewdata = $view->getData();

        if(isset($viewdata['user_trainer']))
        {
            $userTrainer = $viewdata['user_trainer'];

            $trainerDetails = $userTrainer->trainer;
        }
        else
        {
            $userTrainer = $viewdata['trainer']->user;

            $trainerDetails = $viewdata['trainer'];
        }


        $orientation = $viewdata['orientation'];

        $gender = $userTrainer->gender;


        if ($gender == 0) {
            $gender = 'female';
        } else {
            $gender = 'male';
        }

        $dob = $userTrainer->dob;

        $from = new DateTime($dob);
        $to = new DateTime('today');
        $age = $from->diff($to)->y;

        $bio = $trainerDetails->bio;
        $profession = $trainerDetails->profession;
        if ($orientation == 'landscape') {
            JavaScript::put(array('initReadMore' => 1)); // Initialise read more.
        }


        $view
            ->with('gender', $gender)
            ->with('age', $age)
            ->with('bio', $bio)
            ->with('profession', $profession);
    }
} 