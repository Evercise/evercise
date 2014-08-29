<?php namespace composers;
 
class CartRowsComposer {

	public function compose($view)
  	{
  		$viewdata= $view->getData();

  		$sessionId = $viewdata['sessionId'];
  		$sessionIds = $viewdata['sessionIds'];

  		if(($key = array_search($sessionId, $sessionIds)) !== false) {
		    unset($sessionIds[$key]);
		}

  		$view->with('session_ids' , $sessionIds);
  	}
}