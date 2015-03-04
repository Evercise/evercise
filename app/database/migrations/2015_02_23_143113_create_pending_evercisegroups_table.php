<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingEvercisegroupsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // pending_evercisegroups
        Schema::create('pending_evercisegroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evercisegroup_id');
            $table->integer('user_id');
            $table->integer('venue_id');
            $table->text('name');
            $table->text('description');
            $table->text('image');
            $table->text('subcategories');
            $table->text('type');
            $table->integer('status');
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
        Schema::drop('pending_evercisegroups');
    }

}