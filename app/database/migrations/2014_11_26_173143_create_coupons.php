<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoupons extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usage');
            $table->string('coupon');
            $table->string('description');
            $table->enum('type', array('amount', 'package', 'percentage'))->default('amount');
            $table->float('amount');
            $table->integer('percentage');
            $table->tinyInteger('package_id')->default('0');
            $table->timestamp('active_from');
            $table->timestamp('expires_at');
            $table->timestamps();
		});


        $coupon = new Coupons();
        $coupon->usage = 5;
        $coupon->coupon = 'ABCD';
        $coupon->description = 'You got a shitty coupon for some amount';
        $coupon->type = 'amount';
        $coupon->amount = '9.99';
        $coupon->percentage = '0';
        $coupon->package_id = 0;
        $coupon->active_from = '2014-11-17 16:41:33';
        $coupon->expires_at = '2014-12-17 16:41:33';

        $coupon->save();

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coupons');
	}

}
