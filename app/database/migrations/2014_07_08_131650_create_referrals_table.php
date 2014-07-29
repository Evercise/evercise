<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReferralsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('referrals'))
		{
			Schema::create('referrals', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->integer('user_id')->unsigned();// Foreign key
				$table->string('email');
				$table->string('code');
				$table->integer('referee_id')->unsigned();
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
		Schema::drop('referrals');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
