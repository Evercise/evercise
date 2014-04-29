<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trainerhistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainerhistory', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('trainer_historyTypeId');
			$table->integer('trainerHistoryGroupId');
			$table->integer('trainerHistoryGymId');
			$table->integer('trainerHistoryUserId');

			// Foreign Key - user_id
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trainerhistory');
	}

}
