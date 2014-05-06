<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SpecialitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('specialities')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Speciality::create(array('name' => 'kickboxing', 'titles' => 'coach'));
        Speciality::create(array('name' => 'kickboxing', 'titles' => 'trainer'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'guy'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'girl'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'trainer'));
	}

}