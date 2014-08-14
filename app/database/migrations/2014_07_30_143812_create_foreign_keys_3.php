<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('users_groups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('group_id')->references('id')->on('groups');
		});

		Schema::table('sessionpayments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			//$table->foreign('evercisesession_id')->references('id')->on('evercisesessions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('users_groups', function(Blueprint $table) {
			$table->dropForeign('users_groups_user_id_foreign');
			$table->dropForeign('users_groups_group_id_foreign');
		});
		Schema::table('sessionpayments', function(Blueprint $table) {
			$table->dropForeign('sessionpayments_user_id_foreign');
			//$table->dropForeign('sessionpayments_evercisesession_id_foreign');
		});
	}

}
