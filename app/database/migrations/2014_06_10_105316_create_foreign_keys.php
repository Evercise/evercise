<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('trainers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('specialities_id')->references('id')->on('specialities');
		});
		Schema::table('user_marketingpreferences', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('marketingpreference_id')->references('id')->on('marketingpreferences');
		});
		Schema::table('gyms', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('sessionmember_id')->references('id')->on('sessionmembers');
			$table->foreign('session_id')->references('id')->on('evercisesessions');
			$table->foreign('evercisegroup_id')->references('id')->on('evercisegroups');
			$table->foreign('user_created_id')->references('id')->on('users');
		});
		Schema::table('evercisesessions', function(Blueprint $table) {
			$table->foreign('evercisegroup_id')->references('id')->on('evercisegroups');
		});
		Schema::table('evercisegroups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('category_id')->references('id')->on('categories');
			$table->foreign('venue_id')->references('id')->on('venues');
		});
		Schema::table('trainerhistory', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('user_has_categories', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('category_id')->references('id')->on('categories');
		});
		Schema::table('sessionmembers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('evercisesession_id')->references('id')->on('evercisesessions');
		});
		Schema::table('gym_has_trainers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('gym_id')->references('id')->on('gyms');
			
		});
		Schema::table('featuredgymgroups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('evercisegroup_id')->references('id')->on('evercisegroups');
		});

		Schema::table('venue', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('venue_facilities', function(Blueprint $table) {
			$table->foreign('venue_id')->references('id')->on('venues');
			$table->foreign('facility_id')->references('id')->on('facilities');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
