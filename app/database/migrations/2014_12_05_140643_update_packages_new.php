<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePackagesNew extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        DB::statement('ALTER TABLE  `packages` CHANGE  `price`  `price` DECIMAL( 8, 2 ) NOT NULL');
        DB::statement('ALTER TABLE  `packages` CHANGE  `max_class_price`  `max_class_price` DECIMAL( 8, 2 ) NOT NULL');

        foreach(Packages::all() as $p) {
            switch($p->id) {
                case 1:
                case 4:
                    $p->style = 'green';
                    break;

                case 2:
                case 5:
                    $p->style = 'blue';
                    break;

                case 3:
                case 6:
                    $p->style = 'pink';
                    break;


            }
            $p->save();


        }

    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        return true;
	}

}
