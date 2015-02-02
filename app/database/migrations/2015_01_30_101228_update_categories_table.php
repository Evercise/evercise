<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories', function(Blueprint $table) {
			$table->integer('order');
			$table->tinyInteger('visible');
			$table->text('description');
			$table->text('popular');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subcategories', function(Blueprint $table) {
			$table->dropColumn('order');
			$table->dropColumn('visible');
			$table->dropColumn('description');
			$table->dropColumn('popular');
		});
	}

}
