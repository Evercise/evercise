<?php


use Illuminate\Console\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Debug\Exception\FatalErrorException;


class FixLocation extends Command
{

    protected $name = 'location:fix';

    protected $description = 'Fix Messed Up Locations';


    public function __construct()
    {
        parent::__construct();
    }


    public function fire()
    {
        $id = $this->option('id');
        $doPlaces = $this->option('places');


        if ($doPlaces) {
            $places = Place::where('id', '>', $id)->limit(500)->get();

            foreach ($places as $place) {

                $name = $place->name;
                if ($place->link->type == 'STATION') {
                    $name .= ' station';
                }
                $geo = Place::getLocation($name, 'London', FALSE);

                $this->line($name);
                $this->line($geo['latitude'] . ', ' . $geo['longitude']);

                if (!empty($geo['latitude'])) {
                    $place->lat = $geo['latitude'];
                    $place->lng = $geo['longitude'];

                    $place->save();
                } else {
                    $this->line('MISSING ' . $name . ' ' . $place->id);
                }
                $this->line($place->id);
                if ($place->id % 100 == 0) {
                    $this->line('SLEEP');
                    sleep(3);
                }
            }
        } else {
            //We are doing venues... yea...
            //('id', 'user_id', 'name', 'address', 'town', 'postcode', 'lat', 'lng', 'image');
            $venues = Venue::where('id', '>', $id)->limit(500)->get();

            foreach ($venues as $venue) {

                $this->line('Checking ' . $venue->name . ' ' . $venue->id);
                if ($data = get_location($venue->postcode, $venue->address, $venue->town)) {

                    list($latitude, $longitude) = $data;

                    $this->info('Found it ' . implode(', ', $data));
                    $venue->lat = $latitude;
                    $venue->lng = $longitude;
                    $venue->save();

                }

                if ($venue->id % 100 == 0) {
                    $this->error('SLEEP it off a little bit so google wont bitch about it');
                    sleep(3);
                }

            }

            $this->info('All done');
        }
    }

    protected function getOptions()
    {
        return [
            ['id', NULL, InputOption::VALUE_OPTIONAL, 'Start from ID', 1],
            ['places', NULL, InputOption::VALUE_OPTIONAL, 'Should we do place?', FALSE],
        ];
    }
}