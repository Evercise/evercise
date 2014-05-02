<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SentrySeeder');
        $this->command->info('Sentry tables seeded!');

		$this->call('CategoriesTableSeeder');
        $this->command->info('Categories seeded!');

		$this->call('SpecialitiesTableSeeder');
        $this->command->info('Specialities seeded!');

        $this->call('MarketingpreferencesTableSeeder');
        $this->command->info('Marketing prefs seeded!');

        $this->call('GymsTableSeeder');
        $this->command->info('Gyms seeded!');
	}

}