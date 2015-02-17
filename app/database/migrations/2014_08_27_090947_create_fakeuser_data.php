<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakeuserData extends Migration
{

    /**
     * Create the
     *
     * @return void
     */
    public function up()
    {

        //Check if Fake Group Exists
        $fake_group = DB::select('select * from groups where name = ?', array('Fakeuser'));

        if (count($fake_group) == 0) {
            Sentry::getGroupProvider()->create(
                array(
                    'name'        => 'Fakeuser',
                    'permissions' => array('fakeuser' => 1),
                )
            );
        }

        // Find the Fakeuser group
        $fake_user_group = Sentry::findGroupByName('Fakeuser');

        //HardCoded Users IDS from the current DB
        $user_ids = [450,449,448,447,446,445,444,443,442,441,438,437,436,435,434,433,432,431,430,429,428,427,426,425,424,423,422,421,420,419,418,417,416,415,414,413,412,411,410,409,407,406,405,402,401,400,399,398,397,394];

        //Modify users to be fakeusers
        foreach ($user_ids as $id) {

            try {
                // Find the user using the user id
                $user = Sentry::findUserByID($id);


                // Check if the user is in the fake user group.. if not add him
                if (!$user->inGroup($fake_user_group)) {
                    $user->addGroup($fake_user_group);
                }
            } catch (\Exception $e) {
                //Looks like he is in group allready
                echo $e->getMessage();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
