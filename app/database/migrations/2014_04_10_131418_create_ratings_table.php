<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('ratings'))
		{
			Schema::create('ratings', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->integer('user_id')->unsigned();// Foreign key
				$table->integer('sessionmember_id')->unsigned();// Foreign key
				$table->integer('session_id')->unsigned();// Foreign key
				$table->integer('evercisegroup_id')->unsigned();// Foreign key
				$table->integer('user_created_id')->unsigned();// Foreign key
				$table->tinyinteger('stars');
				$table->string('comment', 255);
				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('ratings');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
