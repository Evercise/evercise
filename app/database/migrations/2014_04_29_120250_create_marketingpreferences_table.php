<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingpreferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketingpreferences', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 45);
			$table->string('option', 255);
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
		Schema::drop('marketingpreferences');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
