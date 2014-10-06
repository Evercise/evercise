<?php namespace composers;

use Trainer;

class AdminPendingTrainersComposer {

    public function compose($view)
    {
        $view
            ->with('trainers', Trainer::getConfirmedTrainers());
    }
}