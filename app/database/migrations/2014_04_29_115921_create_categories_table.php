<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('categories'))
		{
			Schema::create('categories', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('name',45);
				$table->string('image',100);
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
		Schema::drop('categories');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
