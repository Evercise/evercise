<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalletHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wallet_history', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->decimal('transaction_amount');
			$table->decimal('new_balance');
			$table->integer('session_payment_id');
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
		//Schema::drop('wallet_history');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
