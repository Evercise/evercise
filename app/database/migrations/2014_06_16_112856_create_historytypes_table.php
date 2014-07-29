<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorytypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('historytypes'))
		{
			Schema::create('historytypes', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('name');
				$table->string('description');
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
		Schema::drop('historytypes');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
