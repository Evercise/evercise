<?php


class CategoriesTableSeeder extends Seeder {

	public function run()
	{

        Category::create(array('name' => 'Workout', 'description' => 'Do you want to be physically challenged? Is your goal to tone up, gain muscle, lose weight or combat stress? Choose a workout, either indoors or outdoors, with a qualified instructor who can offer you great advice on your training regime.'));
        Category::create(array('name' => 'Sports', 'description' => 'Do you want to be coached in a competitive sport involving teams, giving you a chance to meet and bond with new people? (or you can sign up with a group of people you know!) Work together to get fit, learn a skill and have great fun while youre at it!'));
        Category::create(array('name' => 'Healthy Living', 'description' => 'Do you want to learn about nutritional, physical, emotional and spiritual practices and how to balance these factors in order to achieve a healthy lifestyle? Find therapists, practitioners, dieticians and trainers to help you strike the balance!'));
        Category::create(array('name' => 'Nutrition', 'description' => 'Find nutritional specialists who will help you learn what, how and when to eat in order to boost your energy levels and achieve maximum health and fitness. Get nutritional advice from the experts and learn healthy recipes.'));
        Category::create(array('name' => 'Injury Recovery', 'description' => 'Is your goal to recover from an injury? Would you benefit from physiotherapy, or would you like to learn exercise techniques to overcome damage to the body, and the safest ways to exercise without aggravating an injury? Find specialists who offer expert training and advice.'));
        Category::create(array('name' => 'Aerobics', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Yoga', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Bootcamp', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Dance', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Spinning', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Pilates', 'description' => 'awaiting details'));
        Category::create(array('name' => 'Sports', 'description' => 'awaiting details'));


	}

}