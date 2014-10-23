<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SeedCategories extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $categories = [
            ['parent_id' => 0,
             'title' => 'Information',
             'main_image' => '',
             'description' => 'Evercise Info',
             'keywords' => 'evercise.com, evercise, information',
             'permalink' => 'information',
            ],
            ['parent_id' => 0,
             'title' => 'Fitness',
             'main_image' => '',
             'description' => 'All About Fitnes',
             'keywords' => 'fitness',
             'permalink' => 'fitness',
            ],
            ['parent_id' => 0,
             'title' => 'Lifestyle',
             'main_image' => '',
             'description' => 'All about lifestyle',
             'keywords' => 'Lifestyle',
             'permalink' => 'lifestyle',
            ],
        ];

        foreach($categories as $cat) {

            ArticleCategories::create($cat);

        }

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('article_categories')->truncate();
    }

}
