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
			$table->string('name', 45);
			$table->string('title', 45);
			$table->string('description', 255);
			$table->string('address', 45)->nullable();
			$table->string('town', 45)->nullable();
			$table->string('postcode', 45)->nullable();
			$table->decimal('lat', 10, 8);
			$table->decimal('long', 11, 8);
			$table->string('image', 100);
			$table->integer('capacity');
			$table->integer('defualt_duration');
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
		Schema::drop('evercisegroups');
	}

}
