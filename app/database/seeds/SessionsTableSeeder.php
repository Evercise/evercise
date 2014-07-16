<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SessionsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('everciseSessions')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		$classdatetimes = DB::connection('mysql_import')->table('classdatetime')->get();

		foreach ($classdatetimes as $classdatetime)
		{
			// classDatetimeId
			// classInfoId
			// classDatetimeSlot
			// classDatetimeParticipant
			// classDatetimeCreateTime
			// classDatetimeEmailedParticipantList
			// classDatetimeFeatured

			$classinfo = DB::connection('mysql_import')->table('classInfo')->where('classInfoId', $classdatetime->classInfoId)->first();

			$evercisegroupId = DB::connection('mysql_import')->table('migrate_groups')->where('classInfoId', $classdatetime->classInfoId)->pluck('evercisegroup_id');

			$evercisegroup = Evercisegroup::find($evercisegroupId);
			if ($evercisegroup)
			{

				$session = Evercisesession::create(array(
					'evercisegroup_id'=>$evercisegroupId,
					'date_time'=>$classdatetime->classDatetimeSlot,
					'price'=>$classinfo->classInfoPrice,
					'duration'=>$classinfo->classInfoDuration
				));

				$payment = Sessionpayment::create([
					'user_id'=>$evercisegroup->user_id,
					'evercisesession_id'=>$session->id,
					'total'=>0,
					'total_after_fees'=>0,
					'commission'=>0,
					'processed'=>1,
				]);

			}
			else
			{
				$this->command->info('Cannot find evercisegroup. id: '.$evercisegroupId.', classinfo id: '.$classdatetime->classInfoId);
			}
		}
	}

}