<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassStats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('evercisegroups', function($table)
        {
            $table->integer('counter')->unsigned();// Foreign key;
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evercisegroups', function($table)
        {
            $table->dropColumn('counter');
        });
    }

}
