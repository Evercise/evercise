<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvercisePermalinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('evercise_links'))
        {
            Schema::create('evercise_links', function(Blueprint $table) {
                    $table->engine = "InnoDB";
                    $table->increments('link_id');
                    $table->integer('parent_id')->unsigned();
                    $table->string ('permalink', 50);
                    $table->enum('type', array('AREA', 'STATION', 'CLASS', 'ZIP'))->default('CLASS');
                    $table->timestamps();

                    //Indexes
                    $table->unique('permalink');
                    $table->index('type');
                    $table->index('parent_id');
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
        Schema::dropIfExists('evercise_links');
	}

}
