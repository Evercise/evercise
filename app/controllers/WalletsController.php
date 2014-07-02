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
		$withdrawal = Input::get('withdrawal');
		$paypal = Input::get('paypal');

		//JavaScript::put(['mailAll' => 1]);

		//return Response::json(['callback' => 'gotoUrl', 'url' => '/ham']);
		return View::make('wallets.create')
		->with('withdrawal', $withdrawal)
		->with('paypal', $paypal);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Response::json(['callback' => 'gotoUrl', 'url' => '/users/2/edit/profile']);
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