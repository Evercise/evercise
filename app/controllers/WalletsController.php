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
		// Not actually used in dashboard - check ShowWalletComposer
		$wallet = Wallet::find($id);

		$balance = number_format((float)$wallet->balance, 2, '.', '');

		return View::make('wallets.show')
				->with('balance', $balance);
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
				'withdrawal' => 'required|max:1000|min:1|numeric',
				'paypal' => 'required|max:255|min:5',
			]
		);
		if($validator->fails()) {

        	$result = array(
	            'validation_failed' => 1,
	            'errors' =>  $validator->errors()->toArray()
	         );
		}
		else{

			$walletBalance = Wallet::where('user_id', $this->user->id)->first()->pluck('balance');

			$withdrawal = Input::get('withdrawal');
			$paypal = Input::get('paypal');

			if ($withdrawal <= $walletBalance)
			{

				return Response::json([
					'callback' => 'openPopup',
					'popup' => (string)(View::make('wallets.create')->with('withdrawal', $withdrawal)->with('paypal', $paypal))
				]);
			}
			else
			{

	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  ['withdrawal'=>'You don`t have that much in your wallet. ' ]
		         );
			}

			//JavaScript::put(['mailAll' => 1]);


/*			return View::make('wallets.create')
			->with('withdrawal', $withdrawal)
			->with('paypal', $paypal);*/
		}

		if(Request::ajax())
        { 	

			return Response::json($result);
        }else{
        	return Redirect::route('trainers.edit')
				->withErrors($validator)
				->withInput();
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
		$validator = Validator::make(
			Input::all(),
			[
				'withdrawal' => 'required|max:1000|min:1|numeric',
				'paypal' => 'required|max:255|min:5',
			]
		);
		if($validator->fails()) {

        	$result = array(
	            'validation_failed' => 1,
	            'errors' =>  $validator->errors()->toArray()
	         );
		}
		else{
			$withdrawalAmount = Input::get('withdrawal');
			$paypal = Input::get('paypal');

			$withdrawal = Withdrawalrequest::create(['user_id'=>$this->user->id, 'amount'=>$withdrawalAmount, 'account'=>$paypal, 'acc_type'=>'paypal', 'processed'=>0]);
			
			if($withdrawal)
			{
				$wallet = Wallet::where('user_id', $this->user->id)->first();
				$wallet->withdraw( $withdrawalAmount );
			
				return Response::json([
					'callback' => 'openConfirmPopup',
					'popup' => (string)(View::make('wallets.confirm')->with('withdrawal', $withdrawalAmount)->with('paypal', $paypal))
				]);
			}

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
	public function updatePaypal($userId)
	{
		$validator = Validator::make(
			Input::all(),
			[
				'updatepaypal' => 'required|max:255|min:5|email',
			]
		);
		if($validator->fails()) {

        	$result = array(
	            'validation_failed' => 1,
	            'errors' =>  $validator->errors()->toArray()
	         );
		}
		else
		{
			$paypal = Input::get('updatepaypal');
			$wallet = Wallet::where('user_id', $this->user->id)->first();
			$wallet->updatePaypal($paypal);

			return Response::json([
				'callback' => 'refreshpage'
			]);
		}

		if(Request::ajax())
        { 	

			return Response::json($result);
        }else{
        	return Redirect::route('trainers.edit')
				->withErrors($validator)
				->withInput();
        }
	}

}