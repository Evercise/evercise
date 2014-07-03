<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithdrawalrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('withdrawalrequests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();// Foreign key
			$table->decimal('amount', 19, 4);
			$table->string('account');
			$table->string('acc_type');
			$table->integer('processed');
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
		Schema::drop('withdrawalrequests');
	}

}
