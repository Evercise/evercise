<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMilestonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('milestones', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key;
			$table->integer('referrals');
			$table->integer('profile');
			$table->integer('facebook');
			$table->integer('twitter');
			$table->integer('reviews');
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
		Schema::drop('milestones');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
