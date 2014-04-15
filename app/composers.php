<?php

View::composer('form.checkbox', function($view)
{
    $view->with('testparam', (isset($testparam) ? $testparam : "this is the default"));
});