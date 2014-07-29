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
		if (! Schema::hasTable('sessionmembers'))
		{
			Schema::create('sessionmembers', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->integer('user_id')->unsigned();// Foreign key
				$table->integer('evercisesession_id')->unsigned();// Foreign key
				$table->string('token', 64);
				$table->string('transaction_id' , 64);
				$table->string('payer_id' , 64);
				$table->string('payment_method' , 64);
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
		Schema::drop('sessionmembers');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
