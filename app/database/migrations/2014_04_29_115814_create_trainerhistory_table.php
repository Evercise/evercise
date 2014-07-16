<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerhistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainerhistory', function(Blueprint $table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key
			$table->integer('historytype_id')->unsigned();// Foreign key
			$table->string('message');
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
		Schema::drop('trainerhistory');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
