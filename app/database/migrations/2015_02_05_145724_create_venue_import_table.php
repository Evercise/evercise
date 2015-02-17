<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueImportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venue_import', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('venue_id');
			$table->integer('external_id');
			$table->integer('external_site_id');
			$table->string('source');

			$table->string('name');
			$table->string('address');
			$table->string('town');
			$table->string('postcode');
			$table->string('lat');
			$table->string('lng');
			$table->string('image');
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
		Schema::drop('venue_import');
	}

}
