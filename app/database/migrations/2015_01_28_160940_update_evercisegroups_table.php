<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEvercisegroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evercisegroups', function(Blueprint $table) {
			$table->tinyInteger('confirmed')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evercisegroups', function(Blueprint $table) {
			$table->dropColumn('confirmed');
		});
	}

}
