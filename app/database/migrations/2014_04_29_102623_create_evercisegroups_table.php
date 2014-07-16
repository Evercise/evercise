<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvercisegroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evercisegroups', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key
			$table->integer('category_id')->unsigned();// Foreign key
			$table->integer('venue_id')->unsigned();// Foreign key
			$table->string('name', 45);
			$table->string('title', 255);
			$table->string('description', 255);
			$table->tinyInteger('gender');
			$table->string('image', 100);
			$table->integer('capacity');
			$table->integer('default_duration');
			$table->decimal('default_price', 6, 2)->default(0.00);
			$table->tinyInteger('published')->default(0);
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
		Schema::drop('evercisegroups');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
