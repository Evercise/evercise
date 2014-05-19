<?php

class ProgressBarComposer {
	public function compose($view)
  	{
  		$viewdata= $view->getData();

  		$members = $viewdata['mem'] ? $viewdata['mem'] : 0;
  		$capacity = $viewdata['cap'];

  		$progress = ($members /$capacity) * 100;
  		
  		$view->with('progress' , $progress);
  	}
}