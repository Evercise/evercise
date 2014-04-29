<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymTrainerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gym_trainer', function($table)
		{
			$table->tinyinteger('status');
			$table->integer('user_id')->unsigned();// Foreign key
			$table->integer('gym_id')->unsigned();// Foreign key
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('gym_trainer');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
