<?php




/* Dynamically load Events from Config */

$cronjobs = Config::get('cronjob');

/** Kill if not active */
if (!$cronjobs['active']) {
    return;
}


/** Since we sometimes have issues with CronLocks not working */
$lock_file = storage_path() . '/cron.lock';
if (is_file($lock_file)) {
    $lock_created_ago = time() - filemtime($lock_file);

    Log::info('Lock Active '.$lock_created_ago);

    /** Delete if the limit passed */
    if ($lock_created_ago > $cronjobs['lock_limit']) {
        unlink($lock_file);
    }
}

Event::listen('cron.collectJobs', function () use ($cronjobs) {

    foreach ($cronjobs['jobs'] as $name => $time) {
        Cron::add($name, $time, function () use ($name) {

            $class_string = 'cronjobs\\' . $name;

            $jobClass = App::make($class_string);

            return $jobClass->run();
        });
    }

});


Event::listen('cron.jobError', function ($name, $return, $runtime, $rundate) {
    Log::error('Job with the name ' . $name . ' returned an error. ' . $return);
});