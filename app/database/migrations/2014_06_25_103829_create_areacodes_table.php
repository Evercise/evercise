<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreacodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areacodes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('area_code', 20);
			$table->string('area_covered', 200);
			$table->string('official_Ofcom', 200);
			$table->string('Previous_BT', 200);
			$table->timestamps();
		});
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
