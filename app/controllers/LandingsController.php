<?php

class LandingsController extends \BaseController {

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
		JavaScript::put(array('initPut' => json_encode(['selector' => '#send_ppc']) ));
		return View::make('landings.create');
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
				//'email' => 'required|email|unique:users,email',
				'email' => 'required|email',
				'category' => 'required',
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
	        	return Redirect::route('landing.category', ['category'=>Input::get('category')])
					->withErrors($validator)
					->withInput();
	        }
		}
		else {

			$email = Input::get('email');
			$categoryId = Input::get('category');

			$ppcCode = Functions::randomPassword(20);
			$ppc = Landing::create([ 'email'=>$email, 'code'=>$ppcCode, 'category_id'=>$categoryId ]);

			Session::put('ppcCode', $ppcCode);

			$category = Category::find($categoryId)->pluck('name');

			if ($ppc)
			{
				Event::fire('landing.ppc', array(
		        	'email' => $email,
		        	'category' => $category,
	            'ppcCode' => $ppcCode
	        ));
			}

		return Redirect::to('users/create');
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


	// Facebook link on landing page clicked
	public function facebookPpc($categoryId)
	{
		$ppcCode = Functions::randomPassword(20);
		$ppc = Landing::create([ 'email'=>'facebook', 'code'=>$ppcCode, 'category_id'=>$categoryId ]);

		Session::put('ppcCategory', $categoryId);
		Session::put('ppcCode', $ppcCode);

		return Redirect::to('login/fb');
	}


	// Accept code from a pay-per-click generated email.
	public function submitPpc($categoryId, $ppcCode)
	{
		Session::put('ppcCategory', $categoryId);
		Session::put('ppcCode', $ppcCode);

		return Redirect::to('users/create');
	}

	// Accept code from a pay-per-click generated email.
	public function landingPpc($categoryId)
	{
		if (in_array($categoryId, Config::get('values')['ppc_categories']))
		{

			$category = Category::find($categoryId);
			
			JavaScript::put(array('initPut' => json_encode(['selector' => '#send_ppc']) ));
			return View::make('landings.create')
			->with('category', $category);
		}
		else
		{
			return Redirect::to('/');
		}
	}

}