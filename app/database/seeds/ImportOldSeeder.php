<?php

class ImportOldSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();


                $this->call('UsersTableSeeder');
                $this->command->info('Users seeded!');

                $this->call('TrainersTableSeeder');
                $this->command->info('Trainers seeded!');

                $this->call('EvercisegroupsTableSeeder');
                $this->command->info('Evercisegroups seeded!');

                $this->call('SessionsTableSeeder');
                $this->command->info('Sessions seeded!');

                $this->call('SessionMembersTableSeeder');
                $this->command->info('SessionMembers seeded!');

	}

}