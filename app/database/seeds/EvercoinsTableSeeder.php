<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EvercoinsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('evercoins')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Evercoin::create(array('user_id' => '1'));

	}

}