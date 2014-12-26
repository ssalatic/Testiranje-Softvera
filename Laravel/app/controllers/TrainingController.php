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
	
	
	public function validate($data)
	{

		$rules = array(
				
				'practice_date' => 'required|date',
				'time' => 'required',
				'teacher' => 'required|integer|exists:user,id',
				'group' => 'integer|required|exists:group,id'
				
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
		$training = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->first()->id;
		
		return Redirect::route('trainings.show', $training);
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
		
		$training = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->first()->id;
		
		$validator = $this->validate(Input::all());
		
		if ($validator->passes()) 
		{
			$trn = new TrainingModel();
			
			$trn->date = Input::get('practice_date').' '.Input::get('time');
			$trn->trainer_id = Input::get('teacher');
			$trn->group_id = Input::get('group');
			$trn->changed_by = Auth::user()->id;
			$trn->save();
			
			$trn->users()->sync(Input::get('users'));
		    
		    return Redirect::route('trainings.show', $training);
		} 
		else 
		{	
			return Redirect::route('trainings.show', $training)->withErrors($validator);	
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
		if (Auth::user()->isAdmin())
		{
			$training = TrainingModel::find($id);
			$trainings = TrainingModel::all();
			$users = $training->users;
		}	
		else if(Auth::user()->isTrainer())
		{
			$training = TrainingModel::find($id);
			$trainings = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->get();
			$users = $training->users;
		}	
		else
		{
			$training = TrainingModel::find($id);
			$trainings = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->get();
			$users = $training->users;
		}
		
		return View::make('pages.practices', array('training' => $training,
												   'trainings' => $trainings,
												   'users' => $users
		));
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
		
		$trn = TrainingModel::find($id);
		
		$validator = $this->validate(Input::all());
		
		if ($validator->passes())
		{
				
			$trn->date = Input::get('practice_date').' '.Input::get('time');
			$trn->trainer_id = Input::get('teacher');
			$trn->group_id = Input::get('group');
			$trn->changed_by = Auth::user()->id;
			$trn->save();
				
			$trn->users()->sync(Input::get('users'));
		
			return Redirect::route('trainings.show', $trn->id);
		}
		else
		{
			return Redirect::route('trainings.show', $trn->id)->withErrors($validator);
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
		TrainingModel::find($id)->delete();
		
		$training = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->first()->id;
		
		return Redirect::route('trainings.show', $training);
	}


}
