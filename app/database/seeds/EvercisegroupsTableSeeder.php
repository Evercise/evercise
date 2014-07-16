<?php

class EvercisegroupsTableSeeder extends Seeder {

	public function run()
	{


		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('everciseGroups')->delete();
        DB::table('migrate_groups')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		$classinfos = DB::connection('mysql_import')->table('classinfo')->get();

		foreach ($classinfos as $classinfo)
		{
			$user = DB::connection('mysql_import')->table('user')->where('Uid', $classinfo->Uid)->first();
			$this->command->info('Creating Venue. user_id:  '. $classinfo->Uid);
			if($user)
			{
				$userEmail = $user->Uemail;
				$newUser = User::where('email', $userEmail)->first();
				if ($newUser)
				{
				
					$address = explode(',',$classinfo->classInfoAddress);

					try
					{

						$venue = Venue::create([
							'user_id' => $newUser->id,
							'name' => $address[0],
							'address' => $address[0],
							'town' => count($address) > 1 ? $address[1] : '',
							'postcode' => count($address) > 2 ? $address[2] : '',
							'lat' => $classinfo->classInfoLatitude,
							'lng' => $classinfo->classInfoLongitude,
							'image' => $classinfo->classInfoImageName,
						]);
						$venueId = $venue->id;
					}
					catch (Exception $e)
					{
						$this->command->info('Cannot make venue. '.$e);
						exit;
					}

					try
					{
						$evercisegroup = EverciseGroup::create([
							'user_id' => $newUser->id,
							'category_id' => $classinfo->classInfoCategory,
							'venue_id' => $venueId,
							'name' => $classinfo->classInfoName,
							'title' => $classinfo->classInfoSubtitle,
							'description' => $classinfo->classInfoDescription,
							'gender' => 0,
							'image' => $classinfo->classInfoImageName,
							'capacity' => $classinfo->classInfoMin,
							'default_duration' => $classinfo->classInfoDuration,
							'default_price' => $classinfo->classInfoPrice,
							'published' => 1,
						]);

						$migrateGroups = DB::table('migrate_groups')->insert(['classInfoId' => $classinfo->classInfoId, 'evercisegroup_id' => $evercisegroup->id]);

					}
					catch (Exception $e)
					{
						$this->command->info('Cannot make evercisegroup. '.$e);
						exit;
					}

					$url = 'http://evercise.com/'.$classinfo->classInfoImageAddress.'/'.$classinfo->classInfoImageName;
			        //$this->command->info('retrieving image: '.$url);
			        $savePath = public_path().'/profiles/'.$newUser->directory.'/'.$classinfo->classInfoImageName;
			        $this->command->info('saving image: '.$savePath);

					try
					{
						$img = file_get_contents($url);
						file_put_contents($savePath, $img);
					}catch (Exception $e)
					{
						// This exception will happen from localhost, as pulling the file from facebook will not work
						$this->command->info('Cannot save image: '.$savePath);
					}
				}
			}
		}
	}

}