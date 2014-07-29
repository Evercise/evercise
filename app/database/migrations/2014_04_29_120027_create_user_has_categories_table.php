<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('user_has_categories'))
		{
			Schema::create('user_has_categories', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->integer('user_id')->unsigned();// Foreign key
				$table->integer('category_id')->unsigned();// Foreign key
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
		Schema::drop('user_has_categories');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
