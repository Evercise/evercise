<?php
/**
 * Simple Cronjob Config File.
 * Manage all cronjobs from here
 *
 * *    *    *    *    *    *
 * -    -    -    -    -    -
 * |    |    |    |    |    |
 * |    |    |    |    |    + year [optional]
 * |    |    |    |    +----- day of week (0 - 7) (Sunday=0 or 7)
 * |    |    |    +---------- month (1 - 12)
 * |    |    +--------------- day of month (1 - 31)
 * |    +-------------------- hour (0 - 23)
 * +------------------------- min (0 - 59)
 *
 *
 */

return [
    'active'     => getenv('CRON_ACTIVE') ?: TRUE,
    'lock_limit' => 300,
    'jobs'       => [
        'ReminderForPayments' => '10 9 * 1 *',
        'SendReminderEmailsCron'  => '15 * * * *',
        'SendExtraEmailsCron'     => '15 7 * * *',
        'DailyIndexer'        => '*/15 * * * *',
        'CheckPayments'       => '30 5 * * *',
        'GenerateSalesforceSessionIds'        => '*/5 * * * *',
    ]
];