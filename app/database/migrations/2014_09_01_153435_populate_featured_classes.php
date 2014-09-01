<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateFeaturedClasses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('featured_evercisegroups')->insert(
            [
                ['evercisegroup_id' => 181 ],
                ['evercisegroup_id' => 189 ],
                ['evercisegroup_id' => 21 ],
                ['evercisegroup_id' => 191 ]
            ]

        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
