<?php
 
use App\Models\User;
 
class SentrySeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();
 
        Sentry::getUserProvider()->create(array(
            'email'       => 'admin@evercise.com',
            'password'    => "admin",
            'activated'   => 1,
        ));
 
        Sentry::getGroupProvider()->create(array(
            'name'        => 'User',
            'permissions' => array('user' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Facebook',
            'permissions' => array('facebook' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Trainer',
            'permissions' => array('trainer' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Tester',
            'permissions' => array('tester' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Fakeuser',
            'permissions' => array('fakeuser' => 1),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('admin@evercise.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }
 
}