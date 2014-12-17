<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTransactionItemsAll extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transaction_items', function(Blueprint $table) {
            $table->string('name');
            $table->decimal('final_price', 8,2);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transaction_items', function(Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('final_price');
		});
	}

}
