<?php

class ReferralsController extends \BaseController {

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
		
		$validator = Validator::make(
			Input::all(),
			array(
				'referee_email' => 'required|email',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else {

			$refereeEmail = Input::get('referee_email');
			$referralCode = Functions::randomPassword(20);

			$referral = Referral::create(['user_id'=>$this->user->id, 'email'=>$refereeEmail, 'code'=>$referralCode]);

			$referrerName = $this->user->first_name.' '.$this->user->last_name;

			if ($referral)
			{
				Event::fire('referral.invite', array(
		        	'email' => $refereeEmail,
		            'referralCode' => $referralCode,
		            'referrerName' => $referrerName
		        ));
			}

			return Response::json(['callback'=>'gotoUrl', 'url'=>route('users.edit.tab', [$this->user->id, 'evercoins'])]);
		}
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
	public function submitCode($code)
	{
		Session::put('referralCode', $code);

		return Redirect::to('users/create');
	}

}