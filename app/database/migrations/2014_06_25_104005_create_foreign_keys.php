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
			//$table->foreign('specialities_id')->references('id')->on('specialities');
		});
		Schema::table('user_marketingpreferences', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('marketingpreference_id')->references('id')->on('marketingpreferences');
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
			//$table->foreign('category_id')->references('id')->on('categories');
			$table->foreign('venue_id')->references('id')->on('venues');
		});
		Schema::table('trainerhistory', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('historytype_id')->references('id')->on('historytypes');
		});
		Schema::table('user_has_categories', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('category_id')->references('id')->on('categories');
		});
		Schema::table('sessionmembers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('evercisesession_id')->references('id')->on('evercisesessions');
		});

		Schema::table('venues', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('venue_facilities', function(Blueprint $table) {
			$table->foreign('venue_id')->references('id')->on('venues');
			$table->foreign('facility_id')->references('id')->on('facilities');
		});


		Schema::table('wallets', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('wallethistory', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			//$table->foreign('sessionpayment_id')->references('id')->on('sessionpayments');
		});

		Schema::table('evercoins', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('trainers', function(Blueprint $table) {
			$table->dropForeign('trainers_user_id_foreign');
		});

		Schema::table('user_marketingpreferences', function(Blueprint $table) {
			$table->dropForeign('user_marketingpreferences_user_id_foreign');
			$table->dropForeign('user_marketingpreferences_marketingpreference_id_foreign');
		});

		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_user_id_foreign');
			$table->dropForeign('ratings_sessionmember_id_foreign');
			$table->dropForeign('ratings_session_id_foreign');
			$table->dropForeign('ratings_evercisegroup_id_foreign');
			$table->dropForeign('ratings_user_created_id_foreign');
		});

		Schema::table('evercisesessions', function(Blueprint $table) {
			$table->dropForeign('evercisesessions_evercisegroup_id_foreign');
		});

		Schema::table('evercisegroups', function(Blueprint $table) {
			$table->dropForeign('evercisegroups_user_id_foreign');
			$table->dropForeign('evercisegroups_venue_id_foreign');
		});
		
		Schema::table('trainerhistory', function(Blueprint $table) {
			$table->dropForeign('trainerhistory_user_id_foreign');
			$table->dropForeign('trainerhistory_historytype_id_foreign');
		});
		
		Schema::table('user_has_categories', function(Blueprint $table) {
			$table->dropForeign('user_has_categories_user_id_foreign');
			$table->dropForeign('user_has_categories_category_id_foreign');
		});

		Schema::table('sessionmembers', function(Blueprint $table) {
			$table->dropForeign('sessionmembers_user_id_foreign');
			$table->dropForeign('sessionmembers_evercisesession_id_foreign');
		});

		Schema::table('venues', function(Blueprint $table) {
		$table->dropForeign('venues_user_id_foreign');
		});

		Schema::table('venue_facilities', function(Blueprint $table) {
			$table->dropForeign('venue_facilities_venue_id_foreign');
			$table->dropForeign('venue_facilities_facility_id_foreign');
		});

		Schema::table('wallets', function(Blueprint $table) {
			$table->dropForeign('wallets_user_id_foreign');
		});

		Schema::table('wallethistory', function(Blueprint $table) {
			$table->dropForeign('wallethistory_user_id_foreign');
		});

		Schema::table('evercoins', function(Blueprint $table) {
			$table->dropForeign('evercoins_user_id_foreign');
		});
	}

}
