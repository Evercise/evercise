<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE users MODIFY COLUMN directory varchar(100)');
        DB::statement('ALTER TABLE users MODIFY COLUMN image varchar(100)');
        DB::statement('ALTER TABLE users MODIFY COLUMN categories varchar(45)');
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
