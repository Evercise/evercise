<?php

require 'Functions.php';
require 'composers/HomePageComposer.php';
require 'composers/NavBarComposer.php';
require 'composers/CalendarComposer.php';
require 'composers/MapComposer.php';
require 'composers/TimeComposer.php';
require 'composers/PasswordComposer.php';
require 'composers/DistanceComposer.php';
require 'composers/UpcomingPastSessions.php';
require 'composers/ProgressBarComposer.php';
require 'composers/TrainerBlockComposer.php';
require 'composers/UserEditComposer.php';
require 'composers/TrainerEditFormComposer.php';
require 'composers/DonutChartComposer.php';

View::composer('home', 'HomePageComposer');
View::composer('layouts.header', 'NavBarComposer');
View::composer('widgets.calendar', 'CalendarComposer');
View::composer('widgets.mapForm', 'MapComposer');
View::composer('widgets.time', 'TimeComposer');
View::composer('form.password', 'PasswordComposer');
View::composer('evercisegroups.trainer_index', 'DistanceComposer');
View::composer('layouts.progressbar', 'ProgressBarComposer');
View::composer('trainers.trainerBlock', 'TrainerBlockComposer');
View::composer('sessions.date_list', 'UpcomingPastSessions');
View::composer('users.edit_form', 'UserEditComposer');
View::composer('trainers.editForm', 'TrainerEditFormComposer');
View::composer('widgets.donutChart', 'DonutChartComposer');
