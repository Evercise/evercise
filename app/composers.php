<?php

View::composer('form.password', function($view)
{
    $view->with('confirmation', (isset($view->confirmation) ? $view->confirmation : false));
});