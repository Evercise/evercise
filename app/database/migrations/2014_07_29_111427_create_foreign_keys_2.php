<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

/*		Schema::table('evercoinhistory', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('milestones', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('tokens', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('withdrawalrequests', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('referrals', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			//$table->foreign('referee_id')->references('id')->on('users');
		});*/
		Schema::table('evercisegroup_subcategories', function(Blueprint $table) {
			$table->foreign('evercisegroup_id')->references('id')->on('evercisegroups');
			$table->foreign('subcategory_id')->references('id')->on('subcategories');
		});
		Schema::table('subcategory_categories', function(Blueprint $table) {
			$table->foreign('subcategory_id')->references('id')->on('subcategories');
			$table->foreign('category_id')->references('id')->on('categories');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('evercoinhistory', function(Blueprint $table) {
			$table->dropForeign('evercoinhistory_user_id_foreign');
		});

		Schema::table('milestones', function(Blueprint $table) {
			$table->dropForeign('milestones_user_id_foreign');
		});

		Schema::table('tokens', function(Blueprint $table) {
			$table->dropForeign('tokens_user_id_foreign');
		});

		Schema::table('withdrawalrequests', function(Blueprint $table) {
			$table->dropForeign('withdrawalrequests_user_id_foreign');
		});

		Schema::table('referrals', function(Blueprint $table) {
			$table->dropForeign('referrals_user_id_foreign');
		});

		Schema::table('evercisegroup_subcategories', function(Blueprint $table) {
			$table->dropForeign('evercisegroup_subcategories_evercisegroup_id_foreign');
			$table->dropForeign('evercisegroup_subcategories_subcategory_id_foreign');
		});

		Schema::table('subcategory_categories', function(Blueprint $table) {
			$table->dropForeign('subcategory_categories_subcategory_id_foreign');
			$table->dropForeign('subcategory_categories_category_id_foreign');
		});
	}

}
