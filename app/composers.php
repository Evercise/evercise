<?php


/* Dynamically load Composers from Config */

$composers = Config::get('composers');

foreach ($composers as $composer) {
    foreach ($composer as $name => $class) {
        View::composer($name, '\composers\\' . $class);
    }
}







