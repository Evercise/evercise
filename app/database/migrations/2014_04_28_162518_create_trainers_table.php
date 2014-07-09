<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key
			$table->string('bio');
			$table->string('website', 45);
			$table->boolean('confirmed')->default(0);
			$table->integer('specialities_id')->unsigned();// Foreign key
			$table->string('profession');
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
		Schema::drop('trainers');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
