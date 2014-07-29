<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('subcategories'))
		{
			Schema::create('subcategories', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->increments('id');
				$table->string('name',45);
				$table->string('description',255);
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
		Schema::drop('subcategories');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
