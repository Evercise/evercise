<?php

require_once 'Functions.php';
require_once 'composers/HomePageComposer.php';
require_once 'composers/GroupSetComposer.php';
require_once 'composers/CalendarComposer.php';
require_once 'composers/MapComposer.php';
require_once 'composers/TimeComposer.php';
require_once 'composers/PasswordComposer.php';
require_once 'composers/TrainerBlockComposer.php';
require_once 'composers/UserEditComposer.php';
require_once 'composers/DonutChartComposer.php';
require_once 'composers/ChangePasswordComposer.php';
require_once 'composers/RefineComposer.php';
require_once 'composers/CategoryBoxComposer.php';
require_once 'composers/VenueComposer.php';
require_once 'composers/UserClassesComposer.php';
require_once 'composers/TrainerHistoryComposer.php';
require_once 'composers/UpcomingTrainerSessionsComposer.php';
require_once 'composers/ShowWalletComposer.php';
require_once 'composers/RecommendedClassesComposer.php';
require_once 'composers/ShowEvercoinComposer.php';
require_once 'composers/AccordionComposer.php';
require_once 'composers/PayWithEvercoinsComposer.php';
require_once 'composers/AreacodeComposer.php';
require_once 'composers/SearchClassesComposer.php';
require_once 'composers/CartRowsComposer.php';
require_once 'composers/PhoneComposer.php';
require_once 'composers/AutocompleteLocationComposer.php';
require_once 'composers/AutocompleteCategoryComposer.php';

require_once 'composers/ClassHubComposer.php';
require_once 'composers/EvercisegroupCreateComposer.php';
require_once 'composers/TrainerShowComposer.php';
require_once 'composers/EvercisegroupsShowComposer.php';
require_once 'composers/EvercisegroupsSearchComposer.php';
require_once 'composers/UsersCreateComposer.php';
require_once 'composers/UsersResetPasswordComposer.php';
require_once 'composers/TrainersCreateComposer.php';
require_once 'composers/PpcLandingComposer.php';
require_once 'composers/JoinSessionsComposer.php';

require_once 'composers/ClassPurchaseComposer.php';


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







