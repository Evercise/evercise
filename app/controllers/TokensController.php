<?php

class TokensController extends \BaseController
{
	public function fb()
	{
	    $application = Config::get('facebook');
	    $permissions = 'publish_stream';
	    $url_app = Request::root().'/tokens/fb';

	    // getInstance
	    FacebookConnect::getFacebook($application);
		$getUser = FacebookConnect::getUser($permissions, $url_app); // Return facebook User data

		//return View::make('users/tokens')->with('accessToken', $facebookTokenJSON);

		if($getUser)
		{
			/* not working needs reviewing, not neccesary for now 
			$fbUserProfile = $getUser['user_profile']; // grab the user profile from facebook connect

			$fbUserEmail = $fbUserProfile['email']; // grab the email address
			
			$checkForUser = User::where('email', $fbUserEmail)->first(); // check if a user already exists with this fb account

			if ($checkForUser) {
				return Redirect::to('users/'.$this->user->id.'/edit/evercoins')->with('errorNotification', 'This facebook account has already been redeemed');
			}

			*/
			
			$token = Token::where('user_id', $this->user->id)->first();

            if ($facebookToken = Token::makeFacebookToken($getUser))
            {
                $token->addToken('facebook', $facebookToken);
                event('user.facebook.connected', [$this->user]);
                return Redirect::route('users.edit', [$this->user->display_name, 'wallet'])->with('success', 'Your Facebook account has been linked successfully.');
            }
            else
            {
                return Redirect::route('users.edit', [$this->user->display_name, 'wallet'])->with('error', 'Your Facebook account has already been connected to another Evercise account.');
            }

		}
		return Redirect::route('users.edit', [$this->user->display_name, 'wallet'])->with('error', 'We cannot access your Facebook account.');
	}
	public function tw()
	{
		// Oauth token
		$oAuthToken = Input::get('oauth_token');

		// Verifier token
		$verifier = Input::get('oauth_verifier');

		// Request access token
		$accessToken = Twitter::oAuthAccessToken($oAuthToken, $verifier);


		// redirect URL in twitter app settings: http://dev.evercise.com/tokens/tw
		if($this->user) // This is just to stop it breaking from 127.0.0.1.
		{
			$userId = $this->user->id;
			if($accessToken)
			{
				$token = Token::where('user_id', $userId)->first();
				$token->addToken('twitter', $accessToken);

                event('user.twitter.connected', [$this->user]);
			}
		}
		else
		{
			// Only from localhost because twitter redirects to 127.0.0.1 which buggers it up
			return View::make('users/tokens')->with('accessToken', $accessToken);
		}

        return Redirect::route('users.edit', [$this->user->display_name, 'wallet'])->with('success', 'Your twitter account has been linked successfully.');
	}
}