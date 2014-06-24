<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class HistorytypesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('historytypes')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Historytype::create(array( 'name' => 'created_class',     'description' => 'a new evercisegroup has been created by a trainer'));
        Historytype::create(array( 'name' => 'added_session',     'description' => 'a trainer has added a new session to  evercise group'));
        Historytype::create(array( 'name' => 'deleted_group',     'description' => 'a trainer has deleted an evercisegroup / class'));
        Historytype::create(array( 'name' => 'deleted_session',   'description' => 'a trainer has deleted a session'));
        Historytype::create(array( 'name' => 'joined_group',      'description' => 'a user joined an evercisegroup / class'));
        Historytype::create(array( 'name' => 'rated_session',     'description' => 'a user has left a rating for a session'));
        Historytype::create(array( 'name' => 'left_session_full', 'description' => 'A user has left a session with full refund'));
        Historytype::create(array( 'name' => 'left_session_half', 'description' => 'A user has left a session with 50% refund'));
	}


}