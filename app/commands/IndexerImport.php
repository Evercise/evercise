<?php

use Illuminate\Console\Command;

class IndexerImport extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'indexer:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import stuff';

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
        die(' THIS IS ONLY FOR IMPORTING THE FIRST TIME the CSV we GOT FROM RYAN!!!! ');


        $time_start = microtime(true);
        $db_table = 'TABLE_41';
        if (!Schema::hasColumn($db_table, 'coordinate_type')) {
        Schema::table(
            $db_table,
            function ($table) {
                $table->renameColumn('place_type', 'coordinate_type');
            }
        );

        }
        if (!Schema::hasColumn($db_table, 'place_type')) {
            Schema::table(
                $db_table,
                function ($table) {
                    $table->integer('place_type')->default(0);
                }
            );
        }

        DB::update(
            'update ' . $db_table . ' set coordinate_type = "radius" where coordinate_type = ?',
            array('$db_table')
        );

        DB::update(
            'update ' . $db_table . ' set coordinate_type = "polygon" where coordinate_type = ?',
            array('Polygon')
        );
        DB::update('update ' . $db_table . ' set lat = "" where lat = ?', array('0.01'));
        DB::update('update ' . $db_table . ' set lng = "" where lng = ?', array('0.01'));

        DB::update(
            'update ' . $db_table . ' set category_name = "station" where category_name = ?',
            array('London Underground')
        );
        DB::update(
            'update ' . $db_table . ' set category_name = "area" where category_name = ?',
            array('London Areas')
        );


        $db = DB::table($db_table)->get();


        foreach ($db as $t) {
            $link_db = [
                'permalink' => ($t->category_name == 'station' ? 'london/station/' : 'london/area/') . $t->permalink,
                'type'      => $t->category_name
            ];

            $link = new Link($link_db);

            $data = [
                'name'             => (string) $t->name,
                'place_type'       => 0,
                'lng'              => $t->lng,
                'lat'              => $t->lat,
                'zone'             => $t->zone,
                'poly_coordinates' => $this->fix_coordinates($t->poly_coordinates),
                'coordinate_type'  => $t->place_type
            ];
            Place::create($data)->link()->save($link);

        }


        $this->info('Transfer Completed');

        $this->update_geo();

        $time = microtime(true) - $time_start;

        $this->info('Index a total of ' . round($time, 2) . ' seconds');

    }

    public function update_geo() {

        $this->info('Fix Missing Lat and Lng');

        $place = Place::where('lat', 0)->get();

        $total = 0;
        foreach($place as $p) {
            $total++;
            $geo = Place::getGeo($p->name, true, false);
            $p->lng = $geo['lng'];
            $p->lat = $geo['lat'];
            $p->save();
        }

        $this->info('Total Missing fixed: '.$total);
    }


    public function fix_coordinates($cords) {


        $coordinates = [];
        if(strpos($cords, '),') !== false) {

            $cc = explode('),', $cords);

            foreach($cc as $c) {
                $coordinates[] = explode(',',str_replace(array('(',')'),'', $c));
            }
        } else {
           $cords = str_replace("\r\n", "\n", $cords);

            foreach(explode(",", $cords) as $c) {
                $coordinates[] = explode("\n", $c);

            }


        }

        return (count($coordinates) > 0 ? json_encode($coordinates) : '');


    }


}
