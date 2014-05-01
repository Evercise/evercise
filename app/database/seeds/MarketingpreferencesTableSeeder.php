<?php

class MarketingpreferencesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('marketingpreferences')->delete();

        Marketingpreference::create(array('name' => 'newsletter', 'option' => 'yes'));
        Marketingpreference::create(array('name' => 'newsletter', 'option' => 'no'));

	}

}