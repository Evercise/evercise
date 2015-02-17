<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePackages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{


        Schema::table('packages', function(Blueprint $table) {
            $table->dropColumn('savings');
            $table->string('style');
        });



        $package = [
            'name' => 'WARM UP',
            'description' => 'New to Evercise? This is a great way to sample the Evercise experience and pay as little as £3.99 per class.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 5,
            'price' => 19.99,
            'style' => 'green',
            'active' => 1,
            'max_class_price' => '6.99'

        ];
        Packages::create($package);

        $package = [
            'name' => 'ENDURE',
            'description' => 'Keep on moving! Pick up the pace and bag a 40% discount with this five-class package.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 5,
            'price' => 39.99,
            'style' => 'blue',
            'active' => 1,
            'max_class_price' => '11.99'

        ];
        Packages::create($package);

        $package = [
            'name' => 'BURN',
            'description' => 'Get fully motivated with our top five-class package. Complete access to the Evercise network means this is perfect for discovering new fitness challenges.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 5,
            'price' => 59.99,
            'style' => 'pink',
            'active' => 1,
            'max_class_price' => '16.99'

        ];
        Packages::create($package);





        $package = [
            'name' => 'TONED',
            'description' => 'Perfect if you’re starting out. Save money on the standard price without making a big commitment.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 10,
            'price' => 34.99,
            'style' => 'green',
            'active' => 1,
            'max_class_price' => '6.99'

        ];
        Packages::create($package);



        $package = [
            'name' => 'PUMPED',
            'description' => 'A great package if you’re serious about getting fit and staying fit. With a price per class of just £6.99 you’ll be making fitness gains without the financial pains.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 10,
            'price' => 69.99,
            'style' => 'blue',
            'active' => 1,
            'max_class_price' => '11.99'

        ];
        Packages::create($package);




        $package = [
            'name' => 'RIPPED',
            'description' => 'Fitness fanatics look no further. Our top package maximises your Evercise access allowing you to explore our full range of classes.',
            'bullets' => 'Easy check out – no card details required|Waiting list priority – Head straight to the front of the line!',
            'classes' => 10,
            'price' => 99.99,
            'style' => 'pink',
            'active' => 1,
            'max_class_price' => '16.99'

        ];
        Packages::create($package);

    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{


        Schema::table('packages', function(Blueprint $table) {
            $table->dropColumn('style');
            $table->string('savings');
        });

        Packages::limit(10)->delete();
	}

}
