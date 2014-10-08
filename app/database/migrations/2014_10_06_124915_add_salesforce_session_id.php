<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSalesforceSessionId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table(
            'evercisesessions',
            function (Blueprint $table) {
                $table->string('salesforce_id');
            }
        );
    }


    /**
     * Reverse the migrations.  Date_Time__c
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'evercisesessions',
            function (Blueprint $table) {
                $table->dropColumn('salesforce_id');
            }
        );
    }
}
