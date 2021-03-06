<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('sessionpayments'))
		{
			Schema::create('sessionpayments', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->integer('user_id')->unsigned();// Foreign key
				$table->integer('evercisesession_id')->unsigned();// Foreign key
				$table->decimal('total', 19, 4);
				$table->decimal('total_after_fees', 19, 4);
				$table->decimal('commission', 19, 4);
				$table->integer('processed');
				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('sessionpayments');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
