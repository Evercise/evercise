<?php


class CategoriesTableSeeder extends Seeder {

	public function run()
	{
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                DB::table('categories')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');

                Category::create(array('name' => 'Dance', 'image' => 'dance.png'));
                Category::create(array('name' => 'Pilates', 'image' => 'pilates.png'));
                Category::create(array('name' => 'Workout', 'image' => 'workout.png'));
                Category::create(array('name' => 'Martial Arts', 'image' => 'martialarts.png'));
                Category::create(array('name' => 'Yoga', 'image' => 'yoga.png'));
                Category::create(array('name' => 'Sport', 'image' => 'sport.png'));
                Category::create(array('name' => 'Bootcamp', 'image' => 'bootcamp.png'));
                Category::create(array('name' => 'Aerobic', 'image' => 'aerobic.png'));
                Category::create(array('name' => 'Cycling', 'image' => 'cycling.png'));
                Category::create(array('name' => 'Aqua', 'image' => 'aqua.png'));
                Category::create(array('name' => 'Health', 'image' => 'health.png'));
                Category::create(array('name' => 'Injury', 'image' => 'injury.png'));
	}

}