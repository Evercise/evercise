<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMigrateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('migrate_groups', function(Blueprint $table) {
			$table->increments('id')->unsigned();// Foreign key;
			$table->integer('classInfoId')->unsigned();
			$table->integer('evercisegroup_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('migrate_groups');
	}

}
