<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendEmails extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'email:remind';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	protected $cutOff;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

		parent::__construct();

		$cutOffDate = Config::get('pardot.reminders.usercutoff');
		$this->cutOff = new DateTime();
		$this->cutOff->setDate($cutOffDate['year'], $cutOffDate['month'], $cutOffDate['day']);

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$output = $this->remindSessions();
		$this->whyNotReview();

        return $output;
	}


	/**
	 * 	check for users who:
	 *		have attended a class > 4 hours ago but during the last day
	 * 		does not have an entry in 'email_out' matching type 'mail.rateclass'
	 * 		signed up  after 01/12/14
	 *
	 *  If user has no active package,
	 *
	 * @return mixed
	 */
	public function whyNotReview()
	{
		$numHours = Config::get('pardot.reminders.whynotreview.hourssinceclass');

		$this->info('whyNotReview - Searching for users who have bought a class which took place '.$numHours.' hours ago');

		$afewhoursago = (new DateTime())->sub(new DateInterval('PT'.$numHours.'H'));
		$yesterday = (new DateTime())->sub(new DateInterval('P1D'));

		$users = User::whereHas('sessions', function($query) use (&$afewhoursago, &$yesterday){
				$query->where('date_time', '<', $afewhoursago)
					  ->where('date_time', '>', $yesterday);
			})
			->where('created_at', '>', $this->cutOff)
			->with(['emailOut' => function($query){
				$query->where('type', '=', 'mail.rateclass');
			}])
			->get();

		$emailsSent = 0;
		foreach($users as $user) {
			if(! count($user->emailOut)) {
				if (! \UserPackages::hasActivePackage($user)) {  /** hasActivePackage FUNCTION IS DODGY - NEEDS FIXING */
					$emailsSent++;
					$this->info('user: ' . $user->id);
					event('user.class.rate', [$user]);
				}
				else
				{
					$this->info('user: ' . $user->id . 'has active package');
					event('user.class.rate.haspackage', [$user]);
				}
			}
		}

		$this->info('user count: '.$emailsSent);
	}

	/**
	 * Check for sessions happening in less than 2 days
	 * Send a reminder email to all users
	 * Send a participant list to the trainer
	 *
	 * @return mixed
	 */
	public function remindSessions()
	{
		$this->info('remindSessions - Searching for Sessions in the next 1 day, which have not yet fired out emails');

		$today = new DateTime();
		$onedaystime = (new DateTime())->add(new DateInterval('P1D'));

		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$onedaystime, &$today)
		{

			$query
				->where('date_time', '<', $onedaystime)
				->where('date_time', '>', $today)
				->whereHas('sessionmembers', function($query2){});
			//$query->whereIn('id', [1,2,6]);

		}), 'user', 'venue')->get();

		$numSessions = 0;
		$emails = [];
		$sessionIds = [];
		foreach ($evercisegroup as $group)
		{
			$numSessions += count($group->evercisesession);
			foreach ($group->evercisesession as $session)
			{
				if ($session->members_emailed == 0)
				{
					$userList = [];
					foreach ($session->users as $user) {
						$userList[$user->first_name.' '.$user->last_name] = [
							'email' => $user->email,
							'transactionId'=>$user->pivot->transaction_id,
						];
					}
					$emails[] = [
						'groupName'=>$group->name,
						'group'=>$group,
						'dateTime'=>$session->date_time,
						'userList' =>$userList,
						'trainer'=>$group->user,
						'location'=>$group->venue->address.', '.$group->venue->town.', '.$group->venue->postcode,
						'classId' => $group->id,
						'sessionId' => $session->id,
					];
					$sessionIds[] = $session->id;
				}
			}
		}
		if (count($emails))
		{
			$this->info('Number of Sessions to be emailed: '.$numSessions);
			foreach($emails as $email)
			{
				$this->info('');
				$this->info('Session: '.$email['groupName'].' - '.$email['dateTime']);
				$this->info('Trainer: '.$email['trainer']->id.' - '.$email['trainer']->display_name);
				$this->info('Venue: '.$email['location']);
				foreach ($email['userList'] as $name => $details)
				{
					$this->info(' -- '.$name.' : '.$details['email']);
				}

				// Pang out an email with a list of users
				Event::fire('session.upcoming_session', [
	            	'userList' => $email['userList'],
	            	'group' => $email['group'],
	                'location' => $email['location'],
	                'dateTime' => $email['dateTime'],
	                'trainerName' => $email['trainer']->first_name.' '.$email['trainer']->last_name,
	                'trainerEmail' => $email['trainer']->email,
	                'classId' => $email['classId'],
	                'sessionId' => $email['sessionId'],
	            ]);

			}

			Evercisesession::whereIn('id', $sessionIds)->update(['members_emailed' => 1]);
		}
		else
		{
			$this->info('No sessions found which have not already sent out emails');
		}

        return 'sessions mailed: '.$numSessions;

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('days', null, InputOption::VALUE_OPTIONAL, 'How many days to search back.', 1),
		);
	}

}
