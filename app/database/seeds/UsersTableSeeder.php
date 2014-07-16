<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{

/*		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/

		$users = DB::connection('mysql_import')->table('user')->get();

		foreach ($users as $user)
		{
			if( true/*strpos($user->Upassword, '$') === 0*/ )
			{
				if($user->Ufullname)
				{
					$exn = explode(" ", $user->Ufullname);
					$fn = $exn[0];
					$ln = explode($fn, $user->Ufullname)[1];
				}else
				{
					$fn = $ln = null;
				}

				try
				{

			        $newUser = Sentry::getUserProvider()->create(array(
			            'email'       => $user->Uemail,
			            'password'    => $user->Upassword,
			            'activated'   => 1,
			            'activation_code'    => '',
			            'activated_at'    => $user->UsignTime,
			            'last_login'    => null,
			            'persist_code'    => null,
			            'reset_password_code'    => null,
			            'first_name'    => $fn,
			            'last_name'    => $ln,
			            'display_name'    => $user->Uname,
			            'gender'    => $user->Usex ? $user->Usex : 0,
			            'dob'    => $user->UDateOfBirth,
			            'area_code'    => '',
			            'phone'    => $user->Uphone,
			            'directory'    => '',
			            'image'    => $user->UheadImageName,
			        ));

			        $newUserRecord = User::find($newUser->id);
			        $newUserRecord->makeUserDir();
			        $newUserRecord->save();

					$url = 'http://evercise.com/'.$user->UheadImageAddress.'/'.$user->UheadImageName;
			        //$this->command->info('retrieving image: '.$url);
			        $savePath = public_path().'/profiles/'.$newUserRecord->directory.'/'.$newUserRecord->image;
			        $this->command->info('saving image: '.$savePath);

			        //if ($user)

					try
					{
						$img = file_get_contents($url);
						file_put_contents($savePath, $img);
					}catch (Exception $e)
					{
						// This exception will happen from localhost, as pulling the file from facebook will not work
						$this->command->info('Cannot save image: '.$savePath);
					}

					Evercoin::create(['user_id'=>$newUserRecord->id, 'balance'=>0]);
					Milestone::create(['user_id'=>$newUserRecord->id]);
					Token::create(['user_id'=>$newUserRecord->id]);
				}
				catch (Exception $e)
				{
					$this->command->info('Cannot make User. '.$user->Uemail);
					
				}
		    }
		}
	}
}