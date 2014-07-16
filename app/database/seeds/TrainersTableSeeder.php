<?php

class TrainersTableSeeder extends Seeder {

	public function run()
	{

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('trainers')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		$bodyinfos = DB::connection('mysql_import')->table('bodyinfo')->get();

		foreach ($bodyinfos as $bodyinfo)
		{
			$user = DB::connection('mysql_import')->table('user')->where('Uid', $bodyinfo->Uid)->first();
			if($user)
			{
				$userEmail = $user->Uemail;

				$newUser = User::where('email', $userEmail)->first();

				if($newUser)
				{
					$newTrainer = Trainer::create([
						'user_id'=>$newUser->id,
						'bio'=>$bodyinfo->bodyInfoBio,
						'website'=>$bodyinfo->bodyInfoWebsite,
						'confirmed'=>1,//$user->UproApplication == 2 ? 1 : 0,
						'profession'=>$bodyinfo->bodyInfoJobTitle
					]);
				}
				else
				{
					$this->command->info('Could not find new user: '.$userEmail);
				}
			}
			else
			{
				$this->command->info('Could not find old user: '.$bodyinfo->Uid);
			}
		}
	}
}