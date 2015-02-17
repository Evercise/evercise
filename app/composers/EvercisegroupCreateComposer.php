<?php namespace composers;

use JavaScript;
use Config;

class EvercisegroupCreateComposer {

  public function compose($view)
  {

  	JavaScript::put(
        [
            'initSlider_price'       	  => 	json_encode(['name'=>'price', 'min'=>1, 'max'=> Config::get('values')['max_price'], 'step'=>0.50, 'value'=>1, 'format'=>'dec']),
            'initSlider_duration'         => 	json_encode(['name'=>'duration', 'min'=>10, 'max'=>240, 'step'=>5, 'value'=>1]),
            'initSlider_maxsize'       	  => 	json_encode(['name'=>'maxsize', 'min'=>1, 'max'=>200, 'step'=>1, 'value'=>1]),
            'initImage'       	  		  => 	json_encode(['ratio' => 'group_ratio']),
            'initPut'       	  		  => 	json_encode(['selector' => '#evercisegroup_create']),
            'initToolTip'       	  	  => 	1
        ]
    );


  	$view;
  }
}