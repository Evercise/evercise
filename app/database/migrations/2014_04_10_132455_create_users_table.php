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
		Schema::table('users', function($table)
		{
			
			// Evercise
			$table->string('display_name', 45);
			$table->tinyInteger('gender');
			$table->timestamp('dob');
			$table->string('phone', 20);
			$table->string('directory', 45);
			$table->string('image', 45);
			$table->string('categories', 45);
			$table->string('remember_token', 100)->nullable();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('users');
	}

}
