<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VenuesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('venues')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Venue::create(array('name' => 'Greenlight', 'town' => 'London', 'postcode' => 'h4', 'lat' => '51.50682494', 'lng' => '-0.15704746'));
	}


}