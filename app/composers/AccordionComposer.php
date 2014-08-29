<?php namespace composers;
 
use JavaScript;

class AccordionComposer {
 
  public function compose($view)
  {
  	JavaScript::put(['InitAccordian' => 1, 'initSwitchView' => 1 ]);
  }
}