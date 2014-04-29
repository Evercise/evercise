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
		Schema::drop('user_has_marketingpreferences');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
