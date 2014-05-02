<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GymsTableSeeder extends Seeder {

	public function run()
	{

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('gyms')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Gym::create(array('user_id' => '1', 'name' => 'Evercise', 'title' => 'Evercise Gym', 'description' => 'Its super cool'));
	}

}