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
		Schema::create('featuredgymgroup', function($table)
		{
			$table->integer('user_id')->unsigned();// Foreign key
			$table->integer('evercisegroup_id')->unsigned();// Foreign key
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('featuredgymgroup');
	}

}
