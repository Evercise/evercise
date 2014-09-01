<?php namespace composers;

use JavaScript;

class AdminGroupComposer {

    public function compose($view)
    {
        JavaScript::put(['initSearchByName' => 1 ]);

        return $view;
    }
}