<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSubcategoryAssociations extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table(
			'subcategories',
			function ($table) {
				$table->string('associations', 500);
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(
			'subcategories',
			function ($table) {
				$table->dropColumn('associations');
			}
		);
	}

}
