<?php

return [
    'active'     => getenv('CRON_ACTIVE') ?: TRUE,
    'lock_limit' => 300,
    'jobs'       => [
        'ReminderForPayments' => '* * * * *'
    ]
];