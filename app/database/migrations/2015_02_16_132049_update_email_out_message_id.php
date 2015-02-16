<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateEmailOutMessageId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('email_out', function(Blueprint $table) {
			$table->string('message_id');
			$table->string('email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('email_out', function(Blueprint $table) {
            $table->dropColumn('message_id');
            $table->dropColumn('email');
		});
	}

}
