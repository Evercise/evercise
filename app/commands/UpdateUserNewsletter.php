<?php

use Illuminate\Console\Command;


class UpdateUserNewsletter extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe all undecided users to the newsletter';

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
        $done = 0;
        foreach (User::all() as $user) {
            if (is_null($user->newsletter) || $user->newsletter()->count() == 0) {
                $user->marketingpreferences()->sync([1]);
                $done++;
            }
        }

        $this->line('Added ' . $done . ' users to the newsletter');
    }


}
