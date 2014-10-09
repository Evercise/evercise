<?php

use Illuminate\Console\Command;


class SalesforceTruncate extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'salesforce:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all data from SalesForce';

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
        $this->error('DELETING ALL DATA FROM SALESFORCE items');
        if (!$this->confirm('Do you wish to continue? [yes|no]'))
        {
            $this->line('Stopping action');
            die();
        }


        $chunk_limit = 199;
        $deleteResult = 0;

        /** Get All IDS from SalesForce Contacts */
        $query = 'SELECT Id  from Class_Registrant__c limit 5000';

        $res = Salesforce::query($query);

        $ids = [];

        foreach($res->records as $r) {
            $ids[] = $r->Id;
        }

        foreach(array_chunk($ids, $chunk_limit) as $chunk) {
            $deleteResult = Salesforce::delete($chunk);
        }
        $this->line(count($deleteResult) . ' Deleted from Class_Registrant__c');


        /** Get All IDS from SalesForce Contacts */
        $query = 'SELECT Id  from Class__c limit 5000';

        $res = Salesforce::query($query);

        $ids = [];

        foreach($res->records as $r) {
            $ids[] = $r->Id;
        }
        foreach(array_chunk($ids, $chunk_limit) as $chunk) {
            $deleteResult = Salesforce::delete($chunk);
        }
        $this->line(count($deleteResult) . ' Deleted from Class__c');

        DB::table('evercisesessions')->update(array('salesforce_id' => ''));





        /** Get All IDS from SalesForce Contacts */
        $query = 'SELECT Id  from Contact limit 1000';

        $res = Salesforce::query($query);

        $ids = [];

        foreach($res->records as $r) {
            $ids[] = $r->Id;
        }

        foreach(array_chunk($ids, $chunk_limit) as $chunk) {
            $deleteResult = Salesforce::delete($chunk);
        }

        $this->line(count($deleteResult) . ' Deleted from Contacts - Salesforce');

        /** Update All Users and set salesforce_id = '' */
        DB::table('users')->update(array('salesforce_id' => ''));






    }

}