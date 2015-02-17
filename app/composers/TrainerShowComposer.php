<?php namespace composers;

use JavaScript;

class TrainerShowComposer
{

    public function compose($view)
    {
        JavaScript::put(
            [
                'mailAll'                 => 1,
                'initSessionListDropdown' => 1,
                'initEvercisegroupsShow'  => 1
            ]
        );
    }
}