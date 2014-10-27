<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticles extends Migration
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
            'articles',
            function (Blueprint $table) {
                $table->increments('id');
                $table->smallInteger('page')->default(0)->unsigned();
                $table->integer('category_id')->default(0)->unsigned();

                $table->string('title', 255);
                $table->string('main_image', 255);
                $table->string('description', 500);
                $table->string('intro', 500);
                $table->string('keywords', 500);
                $table->text('content');
                $table->string('permalink', 255);
                $table->string('template', 255);
                $table->smallInteger('status')->default(0)->unsigned();

                $table->timestamp('published_on');
                $table->timestamps();
            }
        );


        Schema::create(
            'article_categories',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->default(0)->unsigned();

                $table->string('title', 255);
                $table->string('main_image', 255);
                $table->string('description', 500);
                $table->string('keywords', 500);
                $table->string('permalink', 255);
                $table->smallInteger('status')->default(1)->unsigned();

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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_categories');
    }

}
