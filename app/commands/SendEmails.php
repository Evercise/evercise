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
	protected $name = 'emails';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
		// Check for sessions happening in less than 2 days
		//    Send a reminder email to all users
		//    Send a participant list to the trainer
	public function fire()
	{
		$this->info('Searching for Sessions in the next 1 day, which have not yet fired out emails');
		
		$onedaystime = (new DateTime())->add(new DateInterval('P1D'));

		$evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$onedaystime)
		{

			$query->where('date_time', '<', $onedaystime);
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
						$userList[$user->first_name.' '.$user->last_name] = $user->email;
					}
					$emails[] = ['group'=>$group->name, 'dateTime'=>$session->date_time, 'userList' =>$userList, 'trainer'=>$group->user, 'location'=>$group->venue->name];
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
				$this->info('Session: '.$email['group'].' - '.$email['dateTime']);
				$this->info('Trainer: '.$email['trainer']->id.' - '.$email['trainer']->display_name);
				$this->info('Venue: '.$email['location']);
				foreach ($email['userList'] as $name => $userEmail)
				{
					$this->info(' -- '.$name.' : '.$userEmail);

				}
				// Pang out an email with a list of users
				Event::fire('session.upcoming_session', array(
	            	'userList' => $email['userList'], 
	            	'group' => $email['group'], 
	                'location' => $email['location'],
	                'dateTime' => $email['dateTime'],
	                'trainerName' => $email['trainer']->first_name.' '.$email['trainer']->last_name,
	                'trainerEmail' => $email['trainer']->email,
	            ));
			}
			Evercisesession::whereIn('id', $sessionIds)->update(['members_emailed' => 1]);
		}
		else
		{
			$this->info('No sessions found which have not already sent out emails');
		}


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
