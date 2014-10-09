<?php

use Illuminate\Console\Command;


class SalesforceImport extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'salesforce:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Data into Salesforce';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        /** Move all of them */

        $class = [];
        $user = [];

        $users = Sentry::findAllUsers();


        $this->line('Moving '.count($users).' users');

        $moved = 0;
        foreach ($users as $u) {
            $user[$u->id] = $u;
            if (!empty($u->salesforce_id)) {
                /** This one exits */
            } else {
                $moved++;
                if (!empty($u->trainer->id)) {
                    Event::fire('trainer.registered', [$u]);
                } else {
                    Event::fire('user.registered', [$u]);
                }
            }
        }

        $this->line('Moved total of '.$moved.' others were allready mvoed');


        $sessions = Evercisesession::all();
        $this->line('Moving '.count($sessions).' sessions');
        $moved = 0;

        foreach ($sessions as $s) {
            $class[$s->id] = $s;
            if (!empty($s->salesforce_id)) {
                /** This one exits */
            } else {
                $moved++;
                Event::fire('session.create', [$s]);
            }
        }

        $this->line('Moved total of '.$moved.' others were all ready moved');


        $session_users = Sessionmember::all();
        $this->line('Moving '.count($session_users).' Session Members');
        $moved = 0;

        foreach ($session_users as $su) {
            if (!isset($class[$su->evercisesession_id])) {
                $class[$su->evercisesession_id] = Evercisesession::find($su->evercisesession_id);
            }

            if (!isset($user[$su->user_id])) {
                $user[$su->user_id] = Sentry::findUserById($su->user_id);
            }
            if (!empty($su->salesforce_id)) {
                /** This one exits */
            } else {

                $moved++;
                Event::fire('session.payed', [$user[$su->user_id], $class[$su->evercisesession_id]]);
            }
        }

        $this->line('Moved total of '.$moved.' others were all ready moved');



    }

}
