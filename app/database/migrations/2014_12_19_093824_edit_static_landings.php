<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStaticLandings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('static_landings', function(Blueprint $table) {
			$table->decimal('amount', 8,2);
			$table->string('description');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('static_landings', function(Blueprint $table) {
			$table->dropColumn('amount');
			$table->dropColumn('description');
		});
	}

}
