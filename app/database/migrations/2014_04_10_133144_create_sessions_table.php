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
		Schema::create('evercisesessions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('evercisegroup_id')->unsigned();// Foreign key
			$table->timestamp('date_time');
			$table->integer('members')->default(0);
			$table->decimal('price', 6, 2)->default(0.00);
			$table->integer('duration');
			$table->boolean('members_emailed')->default(0);
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
		Schema::drop('evercisesessions');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
