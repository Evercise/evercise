<?php

require 'Functions.php';
require 'composers/HomePageComposer.php';
require 'composers/GroupSetComposer.php';
require 'composers/CalendarComposer.php';
require 'composers/MapComposer.php';
require 'composers/TimeComposer.php';
require 'composers/PasswordComposer.php';
require 'composers/TrainerBlockComposer.php';
require 'composers/UserEditComposer.php';
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
require 'composers/SearchClassesComposer.php';
require 'composers/CartRowsComposer.php';
require 'composers/PhoneComposer.php';
require 'composers/AutocompleteLocationComposer.php';
require 'composers/AutocompleteCategoryComposer.php';

require 'composers/ClassHubComposer.php';
require 'composers/EvercisegroupCreateComposer.php';
require 'composers/TrainerShowComposer.php';
require 'composers/EvercisegroupsShowComposer.php';
require 'composers/EvercisegroupsSearchComposer.php';
require 'composers/UsersCreateComposer.php';
require 'composers/UsersResetPasswordComposer.php';
require 'composers/TrainersCreateComposer.php';
require 'composers/PpcLandingComposer.php';
require 'composers/JoinSessionsComposer.php';

require 'composers/ClassPurchaseComposer.php';


// home
View::composer('home', 'HomePageComposer');
View::composer('home', 'RecommendedClassesComposer');

// users
View::composer('users.edit_form', 'UserEditComposer');
View::composer('users.changepassword', 'ChangePasswordComposer');
View::composer('users.edit', 'UserClassesComposer');
View::composer('users.register', 'AccordionComposer');
View::composer('users.register', 'UsersCreateComposer');
View::composer('users.resetpassword', 'UsersResetPasswordComposer');
View::composer('evercoins.show', 'ShowEvercoinComposer');

//trainers
View::composer('trainers.create', 'TrainersCreateComposer');
View::composer('trainers.edit', 'UserClassesComposer');
View::composer('trainers.trainerHistory', 'TrainerHistoryComposer');
View::composer('trainers.upcoming', 'UpcomingTrainerSessionsComposer');
View::composer('trainers.trainerBlock', 'TrainerBlockComposer');
View::composer('wallets.show', 'ShowWalletComposer');

// evercisegroups
View::composer('evercisegroups.class_hub', 'ClassHubComposer');
View::composer('evercisegroups.create', 'EvercisegroupCreateComposer');
View::composer('evercisegroups.refine', 'SearchClassesComposer');
View::composer('evercisegroups.refine', 'RefineComposer');
View::composer('evercisegroups.category_box', 'CategoryBoxComposer');
View::composer('evercisegroups.recommended', 'RecommendedClassesComposer');
View::composer('evercisegroups.trainer_show', 'TrainerShowComposer');
View::composer('evercisegroups.show', 'EvercisegroupsShowComposer');


// landing pages
View::composer('layouts.create', 'PpcLandingComposer');

// sessions
View::composer('sessions.join', 'JoinSessionsComposer');
View::composer('sessions.confirmation', 'ClassPurchaseComposer');

// venues
View::composer('venues.select', 'VenueComposer');
View::composer('venues.edit_form', 'VenueComposer');

// statis pages
View::composer('static.how_it_works', 'GroupSetComposer');
View::composer('static.how_it_works', 'AccordionComposer');

// widgets
View::composer('widgets.calendar', 'CalendarComposer');
View::composer('widgets.mapForm', 'MapComposer');
View::composer('widgets.time', 'TimeComposer');
View::composer('widgets.donutChart', 'DonutChartComposer');
View::composer('widgets.autocomplete-location', 'AutocompleteLocationComposer');
View::composer('widgets.autocomplete-category', 'AutocompleteCategoryComposer');

// layouts
View::composer('layouts.header', 'GroupSetComposer');
View::composer('form.password', 'PasswordComposer');
View::composer('form.phone', 'AreacodeComposer');
View::composer('form.phone', 'PhoneComposer');

// payments
View::composer('payments.paywithevercoins', 'PayWithEvercoinsComposer');
View::composer('payments.cartrows', 'CartRowsComposer');







