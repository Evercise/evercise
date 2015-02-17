<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnsVenues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE venues MODIFY COLUMN image varchar(255)');
        DB::statement('ALTER TABLE venue_facilities MODIFY COLUMN details varchar(255)');
        DB::statement('ALTER TABLE evercisegroups MODIFY COLUMN title varchar(255)');
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
