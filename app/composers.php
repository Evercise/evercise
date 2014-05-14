<?php

require 'composers/CalendarComposer.php';
require 'composers/MapComposer.php';
require 'composers/TimeComposer.php';
require 'composers/PasswordComposer.php';

View::composer('widgets.calendar', 'CalendarComposer');
View::composer('widgets.mapForm', 'MapComposer');
View::composer('widgets.time', 'TimeComposer');
View::composer('form.password', 'PasswordComposer');