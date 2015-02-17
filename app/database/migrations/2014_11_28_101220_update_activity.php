<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateActivity extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity', function(Blueprint $table) {
            $table->string('title');
            $table->string('image');
            $table->string('link');
            $table->string('link_title');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity', function(Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('image');
            $table->dropColumn('link');
            $table->dropColumn('link_title');
		});
	}

}
