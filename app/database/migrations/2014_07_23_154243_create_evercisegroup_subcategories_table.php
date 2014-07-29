<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvercisegroupSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('evercisegroup_subcategories'))
		{
			Schema::create('evercisegroup_subcategories', function(Blueprint $table) {
				$table->engine = "InnoDB";
				$table->integer('evercisegroup_id')->unsigned();// Foreign key
				$table->integer('subcategory_id')->unsigned();// Foreign key
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
		Schema::drop('evercisegroup_subcategories');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
