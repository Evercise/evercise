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
		Schema::table('trainers', function(Blueprint $table) {
			$table->string('id', 45);
			$table->string('user_id', 45);
			$table->string('created_at', 45);
			$table->string('bio', 45);
			$table->string('website', 45);
			$table->string('profession', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trainers');
	}

}
