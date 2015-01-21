<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchStats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search_stats', function(Blueprint $table) {
			$table->increments('id');
			$table->string('search');
			$table->integer('size');
			$table->integer('user_id');
			$table->string('user_ip');
			$table->string('radius');

			$table->string('url');
			$table->string('url_type');
			$table->string('name');
			$table->string('lat');
			$table->string('lng');
			$table->integer('results');
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
		Schema::drop('search_stats');
	}

}
