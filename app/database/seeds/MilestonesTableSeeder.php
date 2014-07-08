<?php

class MilestonesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('milestones')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Milestone::create(array('user_id' => '1'));

	}

}