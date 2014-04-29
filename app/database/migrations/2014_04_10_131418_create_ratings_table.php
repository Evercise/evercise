<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyinteger('stars');
			$table->string('comment', 255);
			$table->timestamps();
			// Foreign Key - user_id
			// Foreign Key - sessionmember_id
			// Foreign Key - session_id
			// Foreign Key - group_id
			// Foreign Key - user_created_id
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ratings');
	}

}
