<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMigrateSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('migrate_sessions', function(Blueprint $table) {
			$table->engine = "InnoDB";
			$table->increments('id')->unsigned();// Foreign key;
			$table->integer('classDatetimeId')->unsigned();
			$table->integer('evercisesession_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('migrate_sessions');
	}

}
