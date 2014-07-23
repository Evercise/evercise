<?php


class SubcategoriesTableSeeder extends Seeder {

	public function run()
	{

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('subcategory_categories')->delete();
        DB::table('subcategories')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $subcat = Subcategory::create(array('name' => 'Subcat1', 'description' => 'awaiting details'));
        $subcat->categories()->attach(1);


	}


}