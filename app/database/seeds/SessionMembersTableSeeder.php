<?php

class SessionMembersTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sessionmembers')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		$joingroups = DB::connection('mysql_import')->table('joingroup')->get();

		foreach ($joingroups as $joingroup)
		{
			$user = DB::connection('mysql_import')->table('user')->where('Uid', $joingroup->Uid)->first();
			if($user && $joingroup->groupToken !== '666')
			{
				$userEmail = $user->Uemail;
				$newUser = User::where('email', $userEmail)->first();

				$evercisesessionId = DB::table('migrate_sessions')->where('classDatetimeId', $joingroup->groupId)->pluck('evercisesession_id');

				if (Evercisesession::find($joingroup->groupId))
				{
					$newUserId = $newUser->id;
					try
					{
						$newMember = Sessionmember::create([
							'user_id'=>$newUserId,
							'evercisesession_id'=>$evercisesessionId,
							'token'=>$joingroup->groupToken,
							'transaction_id'=>$joingroup->groupTransactionId,
							'payer_id'=>$joingroup->groupPaymentId,
							'payment_method'=>'old'
						]);
					}
					catch (Exception $e)
					{
						$this->command->info('Cannot make sessionmember. evercisesession_id: '.$evercisesessionId.', user id: '.$newUserId);
						//$this->command->info($e);
						//exit;
					}
				}
			}
		}
	}
}