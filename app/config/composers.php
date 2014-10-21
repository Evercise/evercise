<?php

return [
    ['home' => 'HomePageComposer'],
    ['home' => 'RecommendedClassesComposer'],

    // users
    ['users.edit_form' => 'UserEditComposer'],
    ['users.changepassword' => 'ChangePasswordComposer'],
    ['users.edit' => 'UserClassesComposer'],
    ['users.register' => 'AccordionComposer'],
    ['users.register' => 'UsersCreateComposer'],
    ['users.resetpassword' => 'UsersResetPasswordComposer'],
    ['evercoins.show' => 'ShowEvercoinComposer'],

    //trainers
    ['trainers.create' => 'TrainersCreateComposer'],
    ['trainers.edit' => 'UserClassesComposer'],
    ['trainers.editForm' => 'TrainerEditFormComposer'],
    ['trainers.trainerHistory' => 'TrainerHistoryComposer'],
    ['trainers.upcoming' => 'UpcomingTrainerSessionsComposer'],
    ['trainers.trainerBlock' => 'TrainerBlockComposer'],
    ['wallets.show' => 'ShowWalletComposer'],

    // evercisegroups
    ['evercisegroups.class_hub' => 'ClassHubComposer'],
    ['evercisegroups.create' => 'EvercisegroupCreateComposer'],
    ['evercisegroups.refine' => 'SearchClassesComposer'],
    ['evercisegroups.refine' => 'RefineComposer'],
    ['evercisegroups.category_box' => 'CategoryBoxComposer'],
    ['evercisegroups.recommended' => 'RecommendedClassesComposer'],
    ['evercisegroups.trainer_show' => 'TrainerShowComposer'],
    ['evercisegroups.show' => 'EvercisegroupsShowComposer'],
    ['evercisegroups.search' => 'EvercisegroupsSearchComposer'],


    // landing pages
    ['layouts.create' => 'PpcLandingComposer'],

    // sessions
    ['sessions.join' => 'JoinSessionsComposer'],
    ['sessions.confirmation' => 'ClassPurchaseComposer'],

    // venues
    ['venues.select' => 'VenueComposer'],
    ['venues.edit_form' => 'VenueComposer'],

    // statis pages
    ['static.how_it_works' => 'GroupSetComposer'],
    ['static.how_it_works' => 'AccordionComposer'],

    // widgets
    ['widgets.calendar' => 'CalendarComposer'],
    ['widgets.mapForm' => 'MapComposer'],
    ['widgets.time' => 'TimeComposer'],
    ['widgets.donutChart' => 'DonutChartComposer'],
    ['widgets.autocomplete-location' => 'AutocompleteLocationComposer'],
    ['widgets.autocomplete-category' => 'AutocompleteCategoryComposer'],

    // layouts
    ['layouts.header' => 'GroupSetComposer'],
    ['form.password' => 'PasswordComposer'],
    ['form.phone' => 'AreacodeComposer'],
    ['form.phone' => 'PhoneComposer'],

    // payments
    ['payments.paywithevercoins' => 'PayWithEvercoinsComposer'],
    ['payments.cartrows' => 'CartRowsComposer'],

    // admin
    ['admin.groups' => 'AdminGroupComposer'],
    ['admin.pendingwithdrawals' => 'AdminPendingWithdrawalComposer'],
    ['admin.users' => 'AdminShowUsersComposer'],
    ['admin.trainers' => 'AdminShowUsersComposer'],
    ['admin.pendingtrainers' => 'AdminPendingTrainersComposer'],
    ['admin.log' => 'AdminLogComposer'],
    ['admin.categories' => 'AdminCategoriesComposer'],
    ['admin.subcategories' => 'AdminSubcategoriesComposer'],
    ['admin.searchassociations' => 'AdminAssociationsComposer'],


];