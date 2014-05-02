<?php

class MarketingpreferencesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('marketingpreferences')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Marketingpreference::create(array('name' => 'newsletter', 'option' => 'yes'));
        Marketingpreference::create(array('name' => 'newsletter', 'option' => 'no'));

	}

}