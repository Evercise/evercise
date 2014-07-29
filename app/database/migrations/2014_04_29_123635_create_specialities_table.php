<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('specialities'))
		{
			Schema::create('specialities', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('name', 45);
				$table->string('titles', 255);
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
		Schema::drop('specialities');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		
	}

}
