<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsWallethistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wallethistory', function($table)
		{
			$table->dropColumn('sessionpayment_id');
			$table->integer('sessionmember_id')->unsigned();// Foreign key;
			$table->string('description', 500);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wallethistory', function($table)
		{
			$table->integer('sessionpayment_id')->unsigned();
			$table->dropColumn('sessionmember_id');
			$table->dropColumn('description');
		});
	}

}
