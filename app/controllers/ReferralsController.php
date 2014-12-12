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

			try {
				$referral = Referral::checkAndStore($this->user->id, $refereeEmail, $referralCode);
			}catch(Exception $e){
				return Response::json([
					'validation_failed' => 1,
					'errors' =>  ['referee_email' => 'Email address already registered for referral']
				]);
			}

			if ($referral)
			{


                $this->user->milestone->increment('referrals');

				event('referral.invite', [
		        	'email' => $refereeEmail,
		            'referralCode' => $referralCode,
		            'referrerName' => $this->user->first_name.' '.$this->user->last_name,
		            'referrerEmail' => $this->user->email,
					'balanceWithBonus' => ($this->user->balance + Config::get('values')['milestones']['referral']['reward'])
                ]);
			}
		}
		return Response::json(
            [
                'view'  => View::make('v3.layouts.positive-alert')->with('message', 'Referral sent successfully')->with('fixed', TRUE)->render(),
                'referral' => $this->user->milestone->showReferrals()
            ]
        );
	}

	// Accept a code from a friend referral
	public function submitCode($code)
	{
		Session::put('referralCode', $code);

		return Redirect::to('register');
	}

}