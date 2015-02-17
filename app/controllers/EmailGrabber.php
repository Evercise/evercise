<?php

class EmailGrabber extends Controller
{

    /**
     * @var EmailStats
     */
    private $emailstats;

    public function __construct(EmailStats $emailstats) {

        $this->emailstats = $emailstats;
    }
    public function grab() {

        $all = Input::all();

        foreach($all as $a) {
            $stat = [];

            foreach($this->emailstats->fillable as $key) {
                if($key == 'id') {
                    continue;
                }
                if(!empty($a[$key])) {


                    if($key == 'category') {
                        $a[$key] = implode(', ', $a[$key]);
                    }

                    $stat[$key] = $a[$key];
                }
            }


            if(count($stat) > 0) {
                $this->emailstats->create($stat);
            }
        }
    }

}