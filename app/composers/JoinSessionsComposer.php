<?php namespace composers;

use JavaScript;

class JoinSessionsComposer {
 
  public function compose($view)
  {

    // get price and total frm view data

    $viewdata= $view->getData();

    $sessionIds = $viewdata['sessionIds'];
    $total      = isset($viewdata['total'])? $viewdata['total'] : 0;
    $price      = isset($viewdata['price'])? $viewdata['price'] : 0;

  	JavaScript::put(
        [
            'initJoinEvercisegroup'       	  => 	json_encode(['sessions'=> $sessionIds,'total' => $total,'price' => $price])           
        ]
    );
  }
}