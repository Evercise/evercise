<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFakeratingsTableAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('fakeratings')) {
            Schema::create('fakeratings', function(Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('user_id')->unsigned();// Foreign key
                $table->integer('evercisegroup_id')->unsigned();// Foreign key
                $table->tinyinteger('stars');
                $table->string('comment', 255);
                $table->timestamps();
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
        Schema::drop('fakeratings');
	}

}