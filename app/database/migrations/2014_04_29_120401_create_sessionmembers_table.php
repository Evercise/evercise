<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionmembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessionmembers', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('price', 6, 2)->default(0.00);
			$table->boolean('reviewed')->default(0);
			$table->timestamps();

			// Foreign Key - session_id
			// Foreign Key - user_id
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessionmembers');
	}

}
