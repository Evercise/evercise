<?php


use Illuminate\Console\Command;


class FixDisplayNames extends Command
{
    protected $name = 'fix:names';

    protected $description = 'Fix User Display Names';


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
        $users = User::all();

        foreach ($users as $u) {
            $u->display_name = slugIt($u->display_name);
            $this->line(slugIt($u->display_name));
            $u->save();
        }

        $this->info('Done '.count($users));

        $this->info('Indexing DB');
        event('class.index.all');
        $this->info('DONE Indexing DB');
    }


}