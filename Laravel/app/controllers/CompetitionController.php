<?php

class CompetitionController extends \BaseController {
	
	private $competition;
	
	public function __construct(CompetitionModel $comp)
	{
		$this->competition = $comp;
		
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
				
				'id' =>'sometimes|required|integer|unique:competition,id',
				'name' => 'sometimes|alpha_num|max:45',
				'date' => 'sometimes|date',
				'judges' => 'sometimes|alpha_num|max:500',
				'musician' => 'sometimes|alpha_num|max:45',
				'location' => 'sometimes|alpha_num|max:45',
				'solo' => 'sometimes|alpha_num|max:45',
				'competition_type_id' => 'sometimes|integer|exists:competition_type,id',
				'competition_level_id' => 'sometimes|integer|exists:competition_level,id',
				'competition_type.name' => 'sometimes|alpha_num|max:45',
				'competition_type.solo' => 'sometimes|boolean',
				'competition_level.name' => 'sometimes|alpha_num|max:45',
				'competition_file.id' =>'somethimes|required|integer|unique:competition_file,id',
				'competition_file.competition_id' => 'sometimes|integer|exists:competition,id',
				'competition_file.file_name' => 'sometimes|required|max:45',
				'competition_file.file_type' => 'sometimes|alpha_num|max:10',
				'competition_user.result' => 'sometimes|alpha_num|max:45'
				
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
		return View::make('pages.competitions');
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
