<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGymsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gyms', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 45);
			$table->string('title', 45);
			$table->string('description', 45);
			$table->string('directory', 255);
			$table->string('logo_image', 255);
			$table->string('background_image', 255);
			$table->timestamps();
			// Foreign key - user_id
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gyms');
	}

}
