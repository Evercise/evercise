<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wallets', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->decimal('amount');
			$table->decimal('previous_amount');
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
		//Schema::drop('wallets');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
