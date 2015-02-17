<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('processed');
            $table->integer('user_id');
            $table->integer('coupon_id');
            $table->decimal('total', 8, 2);
            $table->decimal('total_after_fees', 8, 2);
            $table->decimal('commission', 8, 2);
            $table->string('payment_method');
            $table->string('token');
            $table->string('transaction');
            $table->string('payer_id');
            $table->timestamps();
        });

        Schema::create('transaction_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('transaction_id');
            $table->string('type');
            $table->integer('evercisesession_id');
            $table->integer('package_id');
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
		Schema::drop('transactions');
	}

}
