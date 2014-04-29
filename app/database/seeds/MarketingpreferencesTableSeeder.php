<?php

class MarketingpreferencesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('marketingpreferences')->delete();

        Marketingpreference::create(array('name' => 'newsletter', 'options' => 'yes'));
        Marketingpreference::create(array('name' => 'newsletter', 'options' => 'no'));

	}

}