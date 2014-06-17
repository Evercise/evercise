<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('historytypes')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		foreach(range(1, 10) as $index)
		{
			User::create([

			]);
		}
	}

}