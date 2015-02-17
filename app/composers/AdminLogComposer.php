<?php namespace composers;


class AdminLogComposer {

    public function compose($view)
    {

        $logFile = file_get_contents('../app/storage/logs/laravel.log', true);

        $logFile = str_replace('[] []', '[] []<br><br><br>', $logFile);
        $logFile = str_replace('#', '<br><span style="color:red;">#</span>', $logFile);

        $view
            ->with('log', $logFile);
    }
}