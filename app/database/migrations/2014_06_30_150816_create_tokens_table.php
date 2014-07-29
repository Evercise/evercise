<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('tokens'))
		{
			Schema::create('tokens', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->integer('user_id')->unsigned();// Foreign key;
				$table->string('facebook');
				$table->string('twitter');
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
		Schema::drop('tokens');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
