<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcategoryCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('subcategory_categories'))
		{
			Schema::create('subcategory_categories', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('subcategory_id')->unsigned();// Foreign key
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
		Schema::drop('subcategory_categories');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
