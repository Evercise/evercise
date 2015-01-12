<?php


return [
    'active'   => getenv('PARDOT_ACTIVE') ?: FALSE,
    'campayns' => [
        'mail' => [
            'welcome' => 3598,
            'welcomefacebook' => 4130,
            'welcomeguest' => 4132,
            'withdrawcompleted' => 4134,
            'userupgrade' => 4136, //Upgrade to Trainer
            'userssessionremind' => 4138,
            'userreviewedclass' => 4140, // User Reviewed Trainer Class
            'userrequestrefund' => 4142, //
            'userleavesession' => 4144, //
            'userlanding' => 4146, //
            'userjoinedtrainerssession' => 4148, //
            'userforgotpassword' => 4150, //
            'userchangedpassword' => 4152, //
            'usercartcompleted' => 4154, //
            'trainerwhynotcreatefirstclass' => 4156, //
            'trainerwhynotcompleteprofile' => 4158, //
            'trainersessionremind' => 4160, //
            'trainerregistered' => 4162, //
            'trainermailall' => 4164, //
            'trainerleavesession' => 4166, //
            'trainerjoinsession' => 4168, //
            'topupcompleted' => 4170, //
            'thanksforreview' => 4172, //
            'thanksforinviting' => 4186, //
            'ppc' => 4174, //
            'mailtrainer' => 4176, //
            'invite' => 4178, //
            'generatestaticlandingemail' => 4180, //
            'classCreatedFirstTime' => 4182, //
            'adminSendReminderForPayments' => 4184, //
        ]
    ],
    'reminders' => [
        'whynotusefreecredit' => ['daysinactive' => 10],
        'whynotreferafriend' => ['dayssinceclass' => 4],
        'whynotreview' => ['hourssinceclass' => 4],
        'usercutoff' => ['year'=>2014, 'month'=>12, 'day'=>01],
    ]
];