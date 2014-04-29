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
			$table->increments('id');
			// Foreign Key - user_id
			// Foreign Key - marketingpreferences_id
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
