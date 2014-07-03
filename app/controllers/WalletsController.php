<?php

class WalletsController extends \BaseController {

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
		$wallet = Wallet::find($id);

		$amount = $wallet->amount;

		return View::make('wallets.show')
				->with('amount', $amount);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$validator = Validator::make(
			Input::all(),
			[
				'withdrawal' => 'required|max:500|min:1|numeric',
				'paypal' => 'required|max:255|min:5',
			]
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
	        	return Redirect::route('trainers.edit')
					->withErrors($validator)
					->withInput();
	        }
		}
		else{

			$withdrawal = Input::get('withdrawal');
			$paypal = Input::get('paypal');

			//JavaScript::put(['mailAll' => 1]);

			return Response::json([
				'callback' => 'openPopup',
				'popup' => (string)(View::make('wallets.create')->with('withdrawal', $withdrawal)->with('paypal', $paypal))
			]);
/*			return View::make('wallets.create')
			->with('withdrawal', $withdrawal)
			->with('paypal', $paypal);*/
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$withdrawalAmount = Input::get('withdrawal');
		$paypal = Input::get('paypal');

		$withdrawal = Withdrawalrequest::create(['user_id'=>$this->user->id, 'amount'=>$withdrawalAmount, 'account'=>$paypal, 'acc_type'=>'paypal', 'processed'=>0]);
		
		if($withdrawal)
		{
			$wallet = Wallet::where('user_id', $this->user->id)->first();
			$wallet->withdraw( $withdrawalAmount );
		
			return Response::json(['callback' => 'confirmWithdrawal', 'amount' => $withdrawalAmount]);
		}
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

}