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
		//Artisan::call('migrate', ['--package' => 'cartalyst/sentry']);

		Schema::table('users', function($table)
		{
			if (!Schema::hasColumn('display_name', 'gender'))
			{
				$table->string('display_name', 45);
				$table->tinyInteger('gender');
				$table->date('dob');
				$table->string('area_code', 20);
				$table->string('phone', 20);
				$table->string('directory', 45);
				$table->string('image', 45);
				$table->string('categories', 45);
				$table->string('remember_token', 100)->nullable();
			}
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
/*		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/
	}

}
