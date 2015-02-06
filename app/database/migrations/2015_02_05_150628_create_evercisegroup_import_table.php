<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvercisegroupImportTable extends Migration {

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
			$table->integer('evercisegroup_id');
			$table->integer('external_id');
			$table->integer('external_site_id');
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
		Schema::drop('venue_import');
	}

}
