<?php

class TokensController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function fb()
	{
	    // Use a single object of a class throughout the lifetime of an application.
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
			$token->addToken('facebook', Token::makeFacebookToken($getUser));
		}
		return Redirect::to('users/'.$this->user->id.'/edit/evercoins');
	}
	public function tw()
	{
		// Oauth token
		$oAuthToken = Input::get('oauth_token');

		// Verifier token
		$verifier = Input::get('oauth_verifier');

		// Request access token
		$accessToken = Twitter::oAuthAccessToken($oAuthToken, $verifier);


		// redirect URL in twitter app settings: http://127.0.0.1:1234/tokens/tw
		if($this->user) // This is just to stop it breaking from 127.0.0.1.
		{
			$userId = $this->user->id;
			if($accessToken)
			{
				$token = Token::where('user_id', $userId)->first();
				$token->addToken('twitter', $accessToken);
			}
		}
		else
		{
			// Only from localhost because twitter redirects to 127.0.0.1 which buggers it up
			return View::make('users/tokens')->with('accessToken', $accessToken);
		}

		return Redirect::to('users/'.$userId.'/edit/evercoins');
	}
}