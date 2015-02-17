<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys4 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('featured_evercisegroups', function(Blueprint $table) {
            $table->foreign('evercisegroup_id')->references('id')->on('evercisegroups');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('featured_evercisegroups', function(Blueprint $table) {
            $table->dropForeign('featured_evercisegroups_evercisegroup_id_foreign');
        });
	}

} 
