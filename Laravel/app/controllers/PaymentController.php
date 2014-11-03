<?php

class PaymentController extends \BaseController {
	
	private $payment;
	
	public function __construct(PaymentModel $comp)
	{
		$this->payment = $comp;
	
		$this->beforeFilter('secure|auth', [
					
				'only' => ['create', 'edit']
	
		]);
	
		$this->beforeFilter('auth|csrf', [
					
				'only' => ['update', 'delete', 'store']
	
		]);
	
		$this->beforeFilter('auth', [
					
				'except' => ['create', 'store', 'update', 'delete', 'edit']
	
		]);
	}
	
	
	public function validate()
	{
	
		$rules = array(
	
				'id' =>'sometimes|required|integer|unique:payment,id',
				'user_id' => 'sometimes|integer|exists:user,id',
				'date_payed' => 'sometimes|date',
				'amount' => 'sometimes|integer',
				'comment' => 'sometimes|alpha_num|max:200'
	
		);
	
		return Validator::make($data, $rules);
	
	}
	
	
	public function authorized()
	{
		if (Auth::user()->userType >= 10)
			return false;
		
		return true;
	}

	
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


}
