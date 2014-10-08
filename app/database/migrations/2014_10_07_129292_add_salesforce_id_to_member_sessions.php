

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSalesforceIdToMemberSessions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'sessionmembers',
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
            'sessionmembers',
            function (Blueprint $table) {
                $table->dropColumn('salesforce_id');
            }
        );
    }
}
