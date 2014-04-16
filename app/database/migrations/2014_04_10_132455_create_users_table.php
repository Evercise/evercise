<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->tinyInteger('gender');
			$table->timestamp('dob');
			$table->string('phone', 20);
			$table->timestamp('lastLogin');
			$table->string('directory', 45);
			$table->string('image', 45);
			$table->string('categories', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
