<?php

class EvercisegroupsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sessionmembers')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		$joingroups = DB::connection('mysql_import')->table('joingroup')->get();

		foreach ($joingroups as $joingroup)
		{
			$user = DB::connection('mysql_import')->table('user')->where('Uid', $joingroup->Uid)->first();
			if($user)
			{
				$userEmail = $user->Uemail;
				$newUser = User::where('email', $userEmail)->first();

				$newMember = Sessionmember::create([
					'user_id'=>$newUser->id,
					'evercisesession_id'=>$joingroup->groupId,
					'token'=>$joingroup->groupTokenId,
					'transaction_id'=>$joingroup->groupTransactionId,
					'payer_id'=>$joingroup->groupPaymentId,
					'payment_method'=>'old',
				]);


				$payment = Sessionpayment::create([
					'user_id'=>$newUser->id,
					'evercisesession_id'=>$joingroup->groupId,
					'total'=>$joingroup->userPaid,
					'total_after_fees'=>$joingroup->userPaid,
					'commission'=>0,
					'processed'=>1,
				]);
			}
		}
	}

}