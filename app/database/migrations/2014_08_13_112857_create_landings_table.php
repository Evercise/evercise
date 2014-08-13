<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLandingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('landings'))
		{
			Schema::create('landings', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('email');
				$table->string('code');
				$table->integer('user_id');
				$table->integer('category_id');
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
		Schema::drop('landings');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
