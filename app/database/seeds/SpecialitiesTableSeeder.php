<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SpecialitiesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('specialities')->delete();

        Speciality::create(array('name' => 'kickboxing', 'titles' => 'coach'));
        Speciality::create(array('name' => 'kickboxing', 'titles' => 'trainer'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'guy'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'girl'));
        Speciality::create(array('name' => 'yoga', 'titles' => 'trainer'));
	}

}