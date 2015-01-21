<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendExtraEmails extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'email:extra';

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
		//$this->whyNoUseFreeCreditEh();
		//$this->whyNotRefer();
	}

	public function whyNotRefer()
	{
		$numDays = Config::get('pardot.reminders.whynotreferafriend.dayssinceclass');

		$this->info('whyNotRefer - Searching for users who have not been registered through a PPC, and have bought a class which took place '.$numDays.' days ago');

		$afewdaysago = (new DateTime())->sub(new DateInterval('P'.$numDays.'D'));

		$users = User::whereHas('sessions', function($query) use (&$afewdaysago){
				$query->where('date_time', '<', $afewdaysago);
			})
			->with(['activities' => function($query){
				$query->where('type', 'ppcstatic')->orWhere('type', 'ppcunique');
			}])
			->where('created_at', '>', $this->cutOff)
			->with(['emailOut' => function($query){
				$query->where('type', '=', 'mail.rateclass');
			}])
			->get();

		$emailsSent = 0;
		foreach($users as $user) {
			if(! count($user->emailOut)) {
				if (! count($user->activities)) {
					$emailsSent++;
					$this->info('user: ' . $user->id);
					event('user.why_not_refer', [$user]);
				}
			}
		}

		$this->info('user count: '.$emailsSent);
	}

	/**
	 * 	check for users who:
	 *		have not logged in for 10 days
	 *		have an activity of type ppcstatic or ppcunique (signed up through PPC)
     *      have > 5 credit in wallet
     *      have never bought a class
	 * 		does not have an entry in 'email_out' matching type 'whynotusefreecredit'
	 * 		signed up  after 01/12/14
	 *
	 * @return mixed
    */
	public function whyNoUseFreeCreditEh()
	{
		$numDays = Config::get('pardot.reminders.whynotusefreecredit.daysinactive'); // How many days user must be inactive before email is fired. should be 10

		$this->info('whyNoUseFreeCreditEh Searching for users who have not used their free credit, and have been inactive for '.$numDays.' days');

		$afewdaysago = (new DateTime())->sub(new DateInterval('P'.$numDays.'D'));

		$users = User::where('last_login', '<', $afewdaysago)
			->whereHas('activities', function($query){
				$query->where('type', 'ppcstatic')->orWhere('type', 'ppcunique');
			})
			->whereHas('wallet', function($query){
				$query->where('balance', '>=', '5');
			})
			->has('sessions', '<', 1)
			->where('created_at', '>', $this->cutOff)
			->with(['emailOut' => function($query){
				$query->where('type', '=', 'mail.notreturned');
			}])
			->get();

		$everciseGroups = Evercisegroup::whereHas('featuredClasses', function($query){})
			->get();

		$this->info('featured group count: '.count($everciseGroups));

		$groups = [];
		foreach($everciseGroups as $group)
			$groups[] = $group;

		$emailsSent = 0;
		foreach($users as $user) {
			if(! count($user->emailOut)) {
				$emailsSent++;
				$randomGroups = [];
				foreach (array_rand($groups, 3) as $key)
					$randomGroups[] = $groups[$key];

				if (count($randomGroups) > 2)
					$this->info('user: ' . $user->id . ' | featured groups: ' . $randomGroups[0]->id . ', ' . $randomGroups[1]->id . ', ' . $randomGroups[2]->id);
				event('user.not_returned', [$user, $randomGroups]);
			}
		}

		$this->info('user count: '.$emailsSent);

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
