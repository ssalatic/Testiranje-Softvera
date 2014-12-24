<?php

class TrainingController extends \BaseController {
	
	private $training;
	
	public function __construct(TrainingModel $trn)
	{
		$this->training = $trn;
		
		$this->beforeFilter('auth', [
					
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
				
				'id' =>'sometimes|required|integer|unique:training,id',
				'date' => 'sometimes|date',
				'trainer_id' => 'sometimes|integer|exists:user,id',
				'finished' => 'sometimes|boolean',
				'changed_by' => 'sometimes|integer|required|exists:user,id',
				'group_id' => 'sometimes|integer|required|exists:group,id'
				
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
		$id = TrainingModel::getVisibleTrainings()[0]->id;
		return Redirect::route('trainings.show', $id);
		//$training = TrainingModel::find(1);
		//$training = TrainingModel::where('id', '=', $id)->get();
		//return View::make('pages.users.index', array('training' => $training));
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
		//$id = TrainingModel::where('id', '=', $id)->first();
		//$training = TrainingModel::find($id);
		$tr = TrainingModel::find($id);
		
		return View::make('pages.trainings', array('tr' => $tr));
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
		return Redirect::route('pages.show', $id);
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
