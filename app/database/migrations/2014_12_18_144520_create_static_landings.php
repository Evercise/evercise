<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticLandings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
		if (! Schema::hasTable('static_landings'))
		{
			Schema::create('static_landings', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('email');
				$table->string('code');
				$table->integer('user_id');
				$table->integer('category_id');
				$table->string('location');
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
		Schema::drop('static_landings');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
