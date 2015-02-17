<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateVenueImport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{


		Schema::dropIfExists('venue_import');
		Schema::create('venue_import', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('venue_id')->default(0);
			$table->integer('external_id');
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

		Schema::dropIfExists('evercisegroup_import');
		Schema::create('evercisegroup_import', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('evercisegroup_id');
			$table->integer('external_id');
			$table->integer('external_venue_id');
			$table->string('source');

			$table->string('name');
			$table->string('description');
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

		Schema::dropIfExists('venue_import');
		Schema::dropIfExists('evercisegroup_import');
	}

}
