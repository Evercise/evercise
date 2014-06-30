<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FacilitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('facilities')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	Facility::create(array('name' => 'Air Conditioning', 'category' => 'Amenity', 'image' => 'air-conditioning.svg'));
	Facility::create(array('name' => 'Satellite TV', 'category' => 'Amenity', 'image' => 'sattelite-tv.svg'));
	Facility::create(array('name' => 'Cafe', 'category' => 'Amenity', 'image' => 'Cafe.svg'));
	Facility::create(array('name' => 'Wi-Fi', 'category' => 'Amenity', 'image' => 'wifi.svg'));
	Facility::create(array('name' => 'Parking', 'category' => 'Amenity', 'image' => 'parking.svg'));
	Facility::create(array('name' => 'Locker', 'category' => 'Amenity', 'image' => 'lockers.svg'));
	Facility::create(array('name' => 'Changing rooms', 'category' => 'Amenity', 'image' => 'changing-rooms.svg'));
	Facility::create(array('name' => 'Crèche', 'category' => 'Amenity', 'image' => 'creche.svg'));
	Facility::create(array('name' => 'No Contract', 'category' => 'Amenity', 'image' => 'no-contract.svg'));
	Facility::create(array('name' => 'Open 24/7', 'category' => 'Amenity', 'image' => 'open-247.svg'));
	Facility::create(array('name' => 'High tech equipment', 'category' => 'Amenity', 'image' => 'hi-tech.svg'));

        Facility::create(array('name' => 'Swimming Pool', 'category' => 'facility', 'image' => 'swimming.svg'));
        Facility::create(array('name' => 'Cardio Machines', 'category' => 'facility', 'image' => 'cardio.svg'));
        Facility::create(array('name' => 'Free weights', 'category' => 'facility', 'image' => 'free-weights.svg'));
        Facility::create(array('name' => 'Resistance Machines', 'category' => 'facility', 'image' => 'resistance-machine.svg'));
        Facility::create(array('name' => 'Sauna', 'category' => 'facility', 'image' => 'sauna.svg'));
        Facility::create(array('name' => 'Steam Room', 'category' => 'facility', 'image' => 'steam-room.svg'));
        Facility::create(array('name' => 'Sun beds', 'category' => 'facility', 'image' => 'sunbeds.svg'));
        Facility::create(array('name' => 'Jacuzzi', 'category' => 'facility', 'image' => 'jacuzzi.svg'));
        Facility::create(array('name' => 'Personal Training', 'category' => 'facility', 'image' => 'personal-training.svg'));
        Facility::create(array('name' => 'Spa facilities', 'category' => 'facility', 'image' => 'spa-facilities.svg'));
        Facility::create(array('name' => 'Mat area', 'category' => 'facility', 'image' => 'mat-area.svg'));
        Facility::create(array('name' => 'Towels', 'category' => 'facility', 'image' => 'towels.svg'));
        Facility::create(array('name' => 'PowerPlate', 'category' => 'facility', 'image' => 'powerplate.svg'));
        Facility::create(array('name' => 'Group Exercise Studio', 'category' => 'facility', 'image' => 'group-exercise.svg'));
        Facility::create(array('name' => 'Squash', 'category' => 'facility', 'image' => 'squash.svg'));
        Facility::create(array('name' => 'Punch Bags', 'category' => 'facility', 'image' => 'punch-bag.svg'));
        Facility::create(array('name' => 'Boxing Ring', 'category' => 'facility', 'image' => 'boxing-ring.svg'));
        Facility::create(array('name' => 'Massage', 'category' => 'facility', 'image' => 'massage.svg'));
        Facility::create(array('name' => 'Outdoor training area', 'category' => 'facility', 'image' => 'outdoor-training.svg'));
        Facility::create(array('name' => 'Olympic Weights', 'category' => 'facility', 'image' => 'olympic-weights.svg'));

        }
}