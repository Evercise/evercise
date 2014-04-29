<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedgymgroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('featuredgymgroups', function($table)
		{
			$table->integer('user_id')->unsigned();// Foreign key
			$table->integer('evercisegroup_id')->unsigned();// Foreign key
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
		Schema::drop('featuredgymgroups');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
