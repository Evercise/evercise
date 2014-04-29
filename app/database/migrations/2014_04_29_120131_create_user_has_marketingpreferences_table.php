<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasMarketingpreferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_marketingpreferences', function(Blueprint $table) {
			$table->integer('user_id')->unsigned();// Foreign key - user_id
			$table->integer('marketingpreferences_id')->unsigned();// Foreign key - user_id
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_marketingpreferences');
	}

}
