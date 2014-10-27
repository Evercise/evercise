<?php namespace composers;

use Trainer;

class AdminHeaderComposer {

    public function compose($view)
    {
        $unconfirmedTrainers = Trainer::getUnconfirmedTrainers();

        return $view
            ->with('unconfirmedTrainers', $unconfirmedTrainers);
    }
}