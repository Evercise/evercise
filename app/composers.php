<?php

require 'Functions.php';
require 'composers/CalendarComposer.php';
require 'composers/MapComposer.php';
require 'composers/TimeComposer.php';
require 'composers/PasswordComposer.php';
require 'composers/DistanceComposer.php';
require 'composers/UpcomingPastSessions.php';
require 'composers/ProgressBarComposer.php';
require 'composers/TrainerBlockComposer.php';

View::composer('widgets.calendar', 'CalendarComposer');
View::composer('widgets.mapForm', 'MapComposer');
View::composer('widgets.time', 'TimeComposer');
View::composer('form.password', 'PasswordComposer');
View::composer('evercisegroups.trainer_index', 'DistanceComposer');
View::composer('evercisegroups.trainer_index', 'UpcomingPastSessions');
View::composer('layouts.progressbar', 'ProgressBarComposer');
View::composer('trainers.trainerBlock', 'TrainerBlockComposer');