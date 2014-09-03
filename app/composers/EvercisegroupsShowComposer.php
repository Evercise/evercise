<?php namespace composers;

use JavaScript;

class EvercisegroupsShowComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [   
            'initJoinEvercisegroup'         =>  1,            
            'initSwitchView'                =>  1,          
            'initScrollAnchor'              =>  1,            
            'MapWidgetloadScript'           =>  json_encode(['mapPointerDraggable' => false]),
            'initToolTip'                   =>  1,           
            'zero_results'       	  	      => 	trans('discover.zero_results')             
        ]
    );


  	$view;
  }
}