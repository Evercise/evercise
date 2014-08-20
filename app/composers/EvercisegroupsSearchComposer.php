<?php
 
class EvercisegroupsSearchComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [   
            'MapWidgetloadScript'  =>  json_encode(['discover'=> true]),
            'initSwitchView'       => 1 ,
            'InitSearchForm'       => 1 ,
            'initClassBlock'       => 1 ,
            'zero_results'         =>trans('discover.zero_results')          
        ]
    );


  	$view;
  }
}