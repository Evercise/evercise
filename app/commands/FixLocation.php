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
        $places = Place::where('id', '>', $id)->limit(500)->get();

        foreach($places as $place) {

            $name = $place->name;
            if($place->link->type == 'STATION') {
                $name .= ' station';
            }
            $geo = Place::getLocation($name, 'London', false);

            $this->line($name);
            $this->line($geo['latitude'].', '.$geo['longitude']);

            if(!empty($geo['latitude'])) {
                $place->lat = $geo['latitude'];
                $place->lng = $geo['longitude'];

                $place->save();
            } else{
                $this->line('MISSING '.$name.' '.$place->id);
            }
            $this->line($place->id);
            if($place->id%100 == 0) {
                $this->line('SLEEP');
                sleep(3);
            }
        }
    }

    protected function getOptions()
    {
        return [
           ['id', null, InputOption::VALUE_OPTIONAL, 'Start from ID', 1],
        ];
    }
}