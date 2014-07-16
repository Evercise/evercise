<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvercoinhistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evercoinhistory', function(Blueprint $table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key;
			$table->decimal('transaction_amount');
			$table->decimal('new_balance');
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
		Schema::drop('evercoinhistory');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
