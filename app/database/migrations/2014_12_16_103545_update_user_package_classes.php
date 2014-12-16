<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUserPackageClasses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_package_classes', function(Blueprint $table) {
			$table->integer('evercisesession_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_package_classes', function(Blueprint $table) {
            $table->dropColumn('evercisesession_id');
        });
	}

}
