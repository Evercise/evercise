<?php

class ReferralsController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Referral::validateEmail(Input::all());

		if($validator->fails()) {
			return Response::json([
				'validation_failed' => 1,
				'errors' =>  $validator->errors()->toArray()
			]);
		}
		else {
			$refereeEmail = Input::get('referee_email');
			$referralCode = Functions::randomPassword(20);

			$referral = Referral::create(['user_id'=>$this->user->id, 'email'=>$refereeEmail, 'code'=>$referralCode]);

			if ($referral)
			{
				Event::fire('referral.invite', array(
		        	'email' => $refereeEmail,
		            'referralCode' => $referralCode,
		            'referrerName' => $this->user->first_name.' '.$this->user->last_name
		        ));
			}
		}
		return Response::json(['success'=>'true']);
	}

	// Accept a code from a friend referral
	public function submitCode($code)
	{
		Session::put('referralCode', $code);

		return Redirect::to('users/create');
	}

}