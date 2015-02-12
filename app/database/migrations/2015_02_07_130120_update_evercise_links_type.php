<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateEverciseLinksType extends Migration {

	public function up()
	{
		DB::statement("ALTER TABLE evercise_links MODIFY COLUMN type ENUM('AREA', 'STATION', 'CLASS', 'ZIP', 'BOROUGH', 'CITY')");
	}

	public function down()
	{
		DB::statement("ALTER TABLE evercise_links MODIFY COLUMN type ENUM('AREA', 'STATION', 'CLASS', 'ZIP')");
	}


}
