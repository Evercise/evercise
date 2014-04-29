<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('date_time');
			$table->integer('members')->default(0);
			$table->decimal('price', 6, 2)->default(0.00);
			$table->boolean('members_emailed')->default(0);
			$table->timestamps();

			// Foreign Key - evercisegroup_id
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessions');
	}

}
