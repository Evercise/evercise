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
		if (! Schema::hasTable('user_marketingpreferences'))
		{
			Schema::create('user_marketingpreferences', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->integer('user_id')->unsigned();// Foreign key - user_id
				$table->integer('marketingpreference_id')->unsigned();// Foreign key - user_id
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
		Schema::drop('user_marketingpreferences');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
