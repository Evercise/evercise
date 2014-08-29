<?php namespace composers;

use JavaScript;
use Speciality;

class TrainerEditFormComposer
{

    public function compose($view)
    {

        $specialities = Speciality::all();
        $disciplines = array();
        $titles = array();
        foreach ($specialities as $sp) {
            if (!isset($titles[$sp->name])) {
                $disciplines[$sp->name] = $sp->name;
                $titles[$sp->name] = array($sp->titles);
            } else {
                array_push($titles[$sp->name], $sp->titles);
            }
        }


        // Pass selected 'title' through to JS so the checkbox can be set after it's initialised with its array
        $viewdata = $view->getData();
        $speciality = $viewdata['speciality'];
        $title = $speciality->titles;

        JavaScript::put(
            ['initTrainerTitles' => json_encode(['titles' => $titles, 'title' => $title]), 'titles' => json_encode($titles)]
        ); // Initialise title swap Trainer JS.

        $view->with('disciplines', $disciplines);
    }
}
