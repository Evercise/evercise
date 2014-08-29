<?php namespace composers;


class PasswordComposer {
 
  public function compose($view)
  {
    $view->with('confirmation', (isset($view->confirmation) ? $view->confirmation : false));
  }
 
}