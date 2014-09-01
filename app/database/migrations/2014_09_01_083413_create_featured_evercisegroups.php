<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedEvercisegroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('featured_evercisegroups'))
        {
            Schema::create('featured_evercisegroups', function(Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('evercisegroup_id')->unsigned();// Foreign key
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
        Schema::drop('featured_evercisegroups');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
