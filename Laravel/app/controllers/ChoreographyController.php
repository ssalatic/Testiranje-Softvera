<?php

class ChoreographyController extends \BaseController {
	
	private $coreography;
	
	public function __construct(CoreographyModel $cor)
	{
		$this->coreography= $cor;
		
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
				
				'id' =>'somethimes|required|integer|unique:choreogrphy,id',
				'name' => 'sometimes|alpha_num|max:45',
				'music' => 'sometimes|alpha_num|max:45',
				// ???? 'rhythm' => 'sometimes|', ????
				'tempo' => 'sometimes|alpha_num|max:45',
				'duration' => 'sometimes|integer',
				'hard' => 'sometimes|boolean',
				'soft' => 'sometimes|boolean',
				'choreography_file.id' =>'somethimes|required|integer|unique:choreography_file,id',
				'choreography_file.choreography_id' => 'sometimes|integer|required|exists:choreography,id',
				'choreography_file.file_name' => 'sometimes|required|max:45',
				'choreography_file.file_type' => 'sometimes|alpha_num|max:10'
				
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
