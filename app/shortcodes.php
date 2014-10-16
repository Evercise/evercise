<?php

/* Dynamically load ShortCode Parsables from Config */

$shortcodes = Config::get('shortcodes');

foreach ($shortcodes as $tag => $class) {
    Shortcode::register($tag, $class);
}



