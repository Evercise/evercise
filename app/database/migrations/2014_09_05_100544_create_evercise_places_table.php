<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvercisePlacesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('places'))
        {

            Schema::create('places', function(Blueprint $table) {
                    $table->engine = "InnoDB";
                    $table->increments('id');
                    $table->string ('name', 255);
                    $table->tinyInteger('place_type', FALSE, TRUE)->default(1);
                    $table->tinyInteger('zone', FALSE, TRUE)->default(1);
                    $table->double('lat');
                    $table->double('lng');
                    $table->text('poly_coordinates');
                    $table->enum('coordinate_type', array('radius', 'polygon'))->default('radius');
                    $table->timestamps();

                    //Indexes
                    $table->index('place_type');
                    $table->index('name');
                    $table->index('coordinate_type');
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
        Schema::dropIfExists('places');
    }

}
