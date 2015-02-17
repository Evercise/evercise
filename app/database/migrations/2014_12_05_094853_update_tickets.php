<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTickets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        $groups = Evercisegroup::all();

        foreach($groups as $g) {
            DB::table('evercisesessions')
                ->where('evercisegroup_id', $g->id)
                ->update(array('tickets' => $g->capacity));

        }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
