<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVenueFacilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venue_facilities', function(Blueprint $table) {
			$table->integer('venue_id')->unsigned();// Foreign key;
			$table->integer('facility_id')->unsigned();// Foreign key;
			$table->string('details');
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
		Schema::drop('venue_facilities');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
