<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailStats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_stats', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('status');
            $table->string('sg_event_id');
            $table->string('reason');
            $table->string('event');
            $table->string('purchase');
            $table->string('email');
            $table->integer('timestamp');
            $table->string('email');
            $table->string('smtp-id');
            $table->string('type');
            $table->string('category');
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
		Schema::drop('email_stats');
	}

}
