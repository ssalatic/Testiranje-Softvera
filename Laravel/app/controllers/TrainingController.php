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
				'group' => 'integer|sometimes|exists:group,id'
				
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
		$training = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->first();
		if ($training != null) {
			$training = $training->id;
			return Redirect::route('trainings.show', $training);			
		} else  
			return Redirect::route('trainings.show', 1);
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
		$training_id = Input::get('id');
		
		$training = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->first();
		if ($training != null)
			$training = $training->id;
		else 
			$training = 1;
		
		$validator = $this->validate(Input::all());
		
		if(true)
		//if ($validator->passes()) 
		{
			$repeat = ((Input::get('repeated') == 'on')?1:0);
			$personal = ((Input::get('personal') == 'on')?1:0);
			
			$groupIds = Input::get('groups');
			
			if(count($groupIds) == 0)
			 $groupIds = [];
			
			$weeks = 1;
			$date = new DateTime(Input::get('practice_date'));
			
			
			if($repeat == 1){
				$weeks = Input::get('weeks') + 1;
			}
			
			echo $weeks;
			
			for($i = 0; $i<$weeks;$i++){
				
				if($personal){
					$newTraining = new TrainingModel();
					$newTraining->date = $date->format('Y-m-d').' '.Input::get('time_hours').':'.Input::get('time_minutes').':0';
					$hours = Input::get('hours');
					$minutes = Input::get('minutes');
					$duration = $hours*60 + $minutes;
					
					$newTraining->duration = $duration;
					$newTraining->changed_by = Auth::user()->id;
					$newTraining->save();
					$newTraining->users()->sync(Input::get('users'));
					
					$newTraining->trainers()->sync(Input::get('trainers'));
				}
				else{
					foreach($groupIds as $groupId){
						$group = GroupModel::find($groupId);
					
						$newTraining = new TrainingModel();
						$newTraining->date = $date->format('Y-m-d').' '.Input::get('time_hours').':'.Input::get('time_minutes').':0';
						$hours = Input::get('hours');
						$minutes = Input::get('minutes');
						$duration = $hours*60 + $minutes;
						
						$newTraining->duration = $duration;
						$newTraining->trainer_id = Input::get('teacher');
						$newTraining->changed_by = Auth::user()->id;
						$newTraining->group_id = $group->id;
						$newTraining->save();
						$newTraining->users()->sync(Input::get('users'));
						$newTraining->trainers()->sync(Input::get('trainers'));
					}	
				}
				$date->modify('+ 1 weeks');
			}
			
			return Redirect::route('trainings.show', $newTraining->id);
			
			/*
			for ($i = 0; $i < 52; $i++) {
				$trn = new TrainingModel();
				
				$trn->date = Input::get('practice_date').' '.Input::get('time');
				$date = new DateTime($trn->date);
				$date->modify('+'.$i.' weeks');
				date_add($date, date_interval_create_from_date_string($i.' weeks'));
				$trn->trainer_id = Input::get('teacher');
				$trn->group_id = Input::get('group');
				$trn->changed_by = Auth::user()->id;
				$trn->save();
				
				$trn->users()->sync(Input::get('users'));
			}
		    
		    return Redirect::route('trainings.show', $training); */
		} 
		else 
		{	
			return Redirect::route('trainings.show', $training_id)->withErrors($validator);
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
			if ($training != null)
				$users = $training->users;
			else 
				$users = null;
		}	
		else if(Auth::user()->isTrainer())
		{
			$training = TrainingModel::find($id);
			$trainings = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->get();
			if ($training != null)
				$users = $training->users;
			else 
				$users = null;
		}	
		else
		{
			$training = TrainingModel::find($id);
			$trainings = Auth::user()->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->get();
			if ($training != null)
				$users = $training->users;
			else 
				$users = null;
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
		
		if(true)
		//if ($validator->passes())
		{
					
			$trn->date = Input::get('practice_date').' '.Input::get('time');
			$trn->trainer_id = Input::get('teacher');
			$trn->group_id = Input::get('group');
			$trn->changed_by = Auth::user()->id;
			$trn->save();
				
			$trn->users()->sync(Input::get('users'), false);
		
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


	public static function getVisibleTrainings(){
		$trainings = TrainingModel::all();
		
		$currentDate = new DateTime();
		$visibleTrainings = array();
		
		foreach($trainings as $training){
			$training_date = new DateTime($training->date);
			$interval = $currentDate->diff($training_date);
			
			$day = $interval->format('%d');
			$yar = $interval->format('%y');
			$mon = $interval->format('%m');
			if($yar == 0 && $mon == 0 && $day < 14)
				array_push($visibleTrainings,$training);
			
		}

		
		
		return $visibleTrainings;
	}

}
