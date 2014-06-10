<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVenuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venues', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key;
			$table->string('name', 45);
			$table->string('address', 45);
			$table->string('town', 45);
			$table->string('postcode', 45);
			$table->decimal('lat', 10, 8);
			$table->decimal('lng', 11, 8);
			$table->string('image', 45);
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
		Schema::drop('venues');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
