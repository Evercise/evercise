<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class HistorytypesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('historytypes')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Historytype::create(array( 'name' => 'created_class', 'description' => 'a new evercisegroup has been created by a trainer'));
        Historytype::create(array( 'name' => 'added_session', 'description' => 'a trainer has added a new session to  evercise group'));
	}


}