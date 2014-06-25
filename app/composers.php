<?php

require 'Functions.php';
require 'composers/HomePageComposer.php';
require 'composers/NavBarComposer.php';
require 'composers/CalendarComposer.php';
require 'composers/MapComposer.php';
require 'composers/TimeComposer.php';
require 'composers/PasswordComposer.php';
require 'composers/DistanceComposer.php';
//require 'composers/UpcomingPastSessions.php';
require 'composers/ProgressBarComposer.php';
require 'composers/TrainerBlockComposer.php';
require 'composers/UserEditComposer.php';
require 'composers/TrainerEditFormComposer.php';
require 'composers/DonutChartComposer.php';
require 'composers/ChangePasswordComposer.php';
require 'composers/RefineComposer.php';
require 'composers/CategoryBoxComposer.php';
require 'composers/VenueComposer.php';
require 'composers/UserClassesComposer.php';
require 'composers/TrainerHistoryComposer.php';
require 'composers/UpcomingTrainerSessionsComposer.php';
require 'composers/ShowWalletComposer.php';
require 'composers/RecommendedClassesComposer.php';
require 'composers/ShowEvercoinComposer.php';
require 'composers/AccordionComposer.php';
require 'composers/PayWithEvercoinsComposer.php';
require 'composers/AreacodeComposer.php';


View::composer('home', 'HomePageComposer');
View::composer('layouts.header', 'NavBarComposer');
View::composer('widgets.calendar', 'CalendarComposer');
View::composer('widgets.mapForm', 'MapComposer');
View::composer('widgets.time', 'TimeComposer');
View::composer('form.password', 'PasswordComposer');
View::composer('evercisegroups.trainer_index', 'DistanceComposer');
View::composer('layouts.classBlock', 'DistanceComposer');
View::composer('evercisegroups.discover_classes_list', 'DistanceComposer');
View::composer('layouts.progressbar', 'ProgressBarComposer');
View::composer('trainers.trainerBlock', 'TrainerBlockComposer');
//View::composer('sessions.date_list', 'UpcomingPastSessions');
View::composer('users.edit_form', 'UserEditComposer');
View::composer('trainers.editForm', 'TrainerEditFormComposer');
View::composer('widgets.donutChart', 'DonutChartComposer');
View::composer('users.changepassword', 'ChangePasswordComposer');
View::composer('evercisegroups.refine', 'RefineComposer');
View::composer('evercisegroups.category_box', 'CategoryBoxComposer');
View::composer('venues.select', 'VenueComposer');
View::composer('users.edit', 'UserClassesComposer');
View::composer('trainers.edit', 'UserClassesComposer');
View::composer('trainers.trainerHistory', 'TrainerHistoryComposer');
View::composer('trainers.upcoming', 'UpcomingTrainerSessionsComposer');
View::composer('wallets.show', 'ShowWalletComposer');
View::composer('evercisegroups.recommended', 'RecommendedClassesComposer');
View::composer('home', 'RecommendedClassesComposer');
View::composer('evercoins.show', 'ShowEvercoinComposer');
View::composer('static.how_it_works', 'AccordionComposer');
View::composer('sessions.paywithevercoins', 'PayWithEvercoinsComposer');
View::composer('form.phone', 'AreacodeComposer');


