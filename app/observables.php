<?php

// Subscribe to User Mailer events
Event::subscribe('email\UserMailer');
Event::subscribe('email\SessionMailer');


/* Dynamically load Events from Config */

$events = Config::get('events');

foreach ($events as $priority => $event_arr) {
    foreach ($event_arr as $event) {
        foreach ($event as $name => $class) {
            Event::listen($name, '\events\\'.$class, $priority);
        }
    }
}