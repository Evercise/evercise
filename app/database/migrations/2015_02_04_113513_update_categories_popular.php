<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoriesPopular extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE categories CHANGE COLUMN popular popular_classes TEXT;');

		Schema::table('categories', function(Blueprint $table) {
			$table->text('popular_subcategories');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE categories CHANGE COLUMN popular_classes popular TEXT;');

		Schema::table('categories', function(Blueprint $table) {
			$table->dropColumn('popular_subcategories');
		});
	}

}
