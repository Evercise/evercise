<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueImages extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        self::down();

        Schema::create(
            'venue_images',
            function (Blueprint $table) {
                $table->increments('image_id');
                $table->integer('venue_id');
                $table->string('file', 255);
                $table->string('thumb', 255);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venue_images');
    }

}
