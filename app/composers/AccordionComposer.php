<?php
 

class AccordionComposer {
 
  public function compose($view)
  {
  	JavaScript::put(array('InitAccordian' => 1 ));
  	JavaScript::put(array('initSwitchView' => 1 ));
  }
}