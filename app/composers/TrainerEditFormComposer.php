<?php namespace composers;

use JavaScript;
use Speciality;

class TrainerEditFormComposer
{

    public function compose($view)
    {

        JavaScript::put(
            [
                'initPut'		 => json_encode(['selector' => '#trainer_edit']),
            ]
        );

    }
}
