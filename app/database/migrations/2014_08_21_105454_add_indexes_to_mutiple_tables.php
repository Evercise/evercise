<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToMutipleTables extends Migration
{

    /**
     * Add Custom Indexes multiple tables
     *
     * @return void
     */
    public function up()
    {
        //Adding a column at the start of the table is not really possible in Laravel (yet)
        //I have to do a raw query to accomplish it


        Schema::table(
            'evercisegroups',
            function ($table) {
                $table->index('published')->unsigned();
            }
        );

        Schema::table(
            'landings',
            function ($table) {
                $table->index('user_id')->unsigned();
                $table->index('category_id')->unsigned();
            }
        );

        DB::statement(
            "ALTER TABLE  `marketingpreferences` CHANGE  `option`  `option` ENUM(  'yes',  'no' ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT  'yes'"
        );

        Schema::table(
            'milestones',
            function ($table) {
                $table->index('facebook')->unsigned();
                $table->index('twitter')->unsigned();
            }
        );

        Schema::table(
            'ratings',
            function ($table) {
                $table->dropForeign('ratings_user_created_id_foreign');
                $table->dropForeign('ratings_evercisegroup_id_foreign');
                $table->dropForeign('ratings_session_id_foreign');
                $table->dropForeign('ratings_sessionmember_id_foreign');


                $table->index('sessionmember_id')->unsigned();
                $table->index('session_id')->unsigned();
                $table->index('evercisegroup_id')->unsigned();
                $table->index('user_created_id')->unsigned();
                $table->index('stars')->unsigned();
            }
        );


        Schema::table(
            'referrals',
            function ($table) {
                $table->index('referee_id')->unsigned();
            }
        );


        Schema::table(
            'trainers',
            function ($table) {
                $table->index('confirmed')->unsigned();
                $table->index('specialities_id')->unsigned();
            }
        );

        DB::statement(
            'ALTER TABLE  `venue_facilities` ADD  `venue_facilities_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST'
        );


        Schema::table(
            'venues',
            function ($table) {
                $table->index('lat');
                $table->index('lng');
            }
        );


        Schema::table(
            'wallethistory',
            function ($table) {
                $table->index('sessionpayment_id');
            }
        );

    }

}
