<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateArticleMeta extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('articles', function(Blueprint $table) {
			$table->string('meta_title');
		});


		foreach(Articles::all() as $article) {
			$article->meta_title = $article->title;
			$article->save();
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('article_meta', function(Blueprint $table) {
			$table->dropIfExists('meta_title');
		});
	}

}
