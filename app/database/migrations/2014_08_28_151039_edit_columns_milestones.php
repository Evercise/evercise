<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnsMilestones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //
        DB::statement('ALTER TABLE milestones MODIFY COLUMN referrals int(11)');
        DB::statement('ALTER TABLE milestones MODIFY COLUMN profile int(11)');
        DB::statement('ALTER TABLE milestones MODIFY COLUMN facebook int(11)');
        DB::statement('ALTER TABLE milestones MODIFY COLUMN twitter int(11)');
        DB::statement('ALTER TABLE milestones MODIFY COLUMN reviews int(11)');
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
