<?php
 
class NavBarComposer {
 
  public function compose($view)
  {
  	$trainerGroup = Sentry::findGroupByName('trainer');

  	/*if ( ! Sentry::check())
	{
		$aboutNav = HTML::linkRoute('static.about', 'About');
		$proNav = HTML::linkRoute('trainers.create', 'I&#039;m a trainer');
		$discoverNav =  HTML::linkRoute('evercisegroups.search', 'Discover classes'); //needs changing to dscover when available
	    $helpNav = HTML::linkRoute('static.faq', 'Help');
	    $joinNav = HTML::linkRoute('users.create', 'Join Evercise');
	    if(isset($redirect_after_login)){
	    	$userNav = HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , 'Login',  array('id'=>'login', 'class' => 'login'));
	    }	
		else{
			$userNav = HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login'));
		}
	}
	else
	{
		$user = Sentry::getUser();

		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($user->inGroup($trainerGroup))
		{
			$aboutNav = HTML::linkRoute('trainers.edit', 'My Dashboard' , $user->id);
			$proNav = HTML::linkRoute('evercisegroups.index', 'Class Hub');
			$discoverNav =   HTML::linkRoute('evercisegroups.search', 'Discover classes'); //needs changing to dscover when available
		    $helpNav = HTML::linkRoute('static.faq', 'Help');
		    $joinNav = null;// change to art when ready
		    $userNav = 'trainer';
		}
		else
		{
			$aboutNav = HTML::linkRoute('users.edit', 'My Dashboard' , $user->id);
			$proNav = HTML::linkRoute('trainers.create', 'I&#039;m a trainer');
			$discoverNav =  HTML::linkRoute('evercisegroups.search', 'Discover classes');
		    $helpNav = null;
		    $joinNav = null; // change to art when ready
		    $userNav = 'user';
		}


	  	$proText = 'Be a pro';
	}
	*/
	

  	$view//->with('aboutNav', $aboutNav)
  			//->with('proNav', $proNav)
  			//->with('discoverNav', $discoverNav)
  			//->with('helpNav', $helpNav)
  			//->with('joinNav', $joinNav)  			
  			//->with('userNav', $userNav)
  			->with('trainerGroup', $trainerGroup);
  			 
  }
}