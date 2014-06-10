<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FacilitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('facilities')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Facility::create(array('name' => 'Rowing Machine', 'category' => 'facility', 'image' => 'rowing.png'));
        Facility::create(array('name' => 'Toilets', 'category' => 'Amenity', 'image' => 'toilets'));
        Facility::create(array('name' => 'Car Park', 'category' => 'Amenity', 'image' => 'carpark'));
        Facility::create(array('name' => 'Hall', 'category' => 'facility', 'image' => 'hall'));
	}

}