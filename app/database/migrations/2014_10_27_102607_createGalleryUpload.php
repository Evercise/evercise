<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryUpload extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        self::down();

        Schema::create(
            'gallery_defaults',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('counter')->default(3)->unsigned();
                $table->string('keywords', 255);
                $table->string('image', 500);
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

        Schema::dropIfExists('gallery_defaults');
    }

}
