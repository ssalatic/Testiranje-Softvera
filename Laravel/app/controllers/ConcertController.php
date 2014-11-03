<?php

class ConcertController extends \BaseController {
	
	private $concert;
	
	public function __construct(ConcertModel $con)
	{
		$this->concert = $con;
		
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
				
				'id' =>'sometimes|required|integer|unique:concert,id',
				'session_id' => 'sometimes|integer',
				'name' => 'sometimes|alpha_num|max:45',
				'location' => 'sometimes|alpha_num|max:45',
				'start_time' => 'sometimes|alpha_num|max:45',
				'end_time' => 'sometimes|alpha_num|max:45',
				'concert_file.id' =>'somethimes|required|integer|unique:concert_file,id',
				'concert_file.concert_id' => 'sometimes|integer|required|exists:concert,id',
				'concert_file.file_name' => 'sometimes|required|max:45',
				'concert_file.file_type' => 'sometimes|alpha_num|max:10'
				
		);
		
		return Validator::make($data, $rules);
		
	}
	
	
	public function authorized()
	{
		if (Auth::user()->userType > 1)
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
