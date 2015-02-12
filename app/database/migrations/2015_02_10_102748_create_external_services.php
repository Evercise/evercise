<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExternalServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('external_services', function(Blueprint $table) {
			$table->increments('id');
			$table->enum('service', ['mindbody']);
			$table->integer('user_id');
			$table->string('site_id');
			$table->string('user_login');
			$table->string('user_pass');
			$table->text('information');
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
		Schema::drop('external_services');
	}

}
