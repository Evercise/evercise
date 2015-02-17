<?php namespace composers;

use JavaScript;

class PpcLandingComposer
{

    public function compose($view)
    {

        JavaScript::put(
            [
                'initPut' => json_encode(['selector' => '#send_ppc'])
            ]
        );
    }
}