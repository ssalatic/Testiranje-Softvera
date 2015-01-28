<?php

class ChoreographyController extends \BaseController {
	
	private $choreography;
	
	public function __construct(ChoreographyModel $cor)
	{
		$this->choreography= $cor;
		
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
				
				'id' =>'sometimes|required|integer|unique:choreogrphy,id',
				'name' => 'sometimes|alpha_num|max:45',
				'music' => 'sometimes|alpha_num|max:45',
				'rhythm' => 'sometimes|alpha_num|max:45',
				'tempo' => 'sometimes|alpha_num|max:45',
				'duration' => 'sometimes|integer'
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
		$choreography = ChoreographyModel::first();
		
		if($choreography == null){
			$choreography = $this->getEmptyObject();
		}
		
		if(Auth::user()->isAdmin() || Auth::user()->isTrainer()){
			return Redirect::route('choreographies.show', $choreography->id);
		}
		else{
			return Redirect::route('pages.index');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.admin_choreography');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = $this->validate(Input::except(['id']));
		if ($validator->passes()){
		
			$choreography = new ChoreographyModel();
			$choreography->name = Input::get('name');
			$choreography->music = Input::get('music');
			
			$choreography->rhythm = Input::get('rhythm');
			$choreography->tempo = Input::get('tempo');
			
			$hours = Input::get('hours');
			$minutes = Input::get('minutes');
			$duration = $hours*60 + $minutes;
			
			$choreography->duration = $duration;
			
			$hard = Input::get('hard');
			$soft = Input::get('soft');
			
			$choreography->hard = (($hard == 'on')?1:0);
			$choreography->soft = (($soft == 'on')?1:0);
			$choreography->save();
			
			return Redirect::route('choreographies.show',$choreography->id)->withErrors($validator)->withInput();
		}else{
			$id = Input::get('id');
			return Redirect::route('choreographies.show',$id)->withErrors($validator)->withInput();
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
		if (Auth::user()->isAdmin() || Auth::user()->isTrainer())
		{
			$choreography = ChoreographyModel::find($id);			
			
			if($choreography == null){
				
				$choreography = $this->getEmptyObject();
				/*
				$choreography = new ChoreographyModel();
				$choreography->name = '';
				$choreography->music = '';
				$choreography->rhythm = '';
				$choreography->tempo = '';
				$choreography->duration = 0;
				$choreography->hard = '';
				$choreography->soft = '';
				
				$choreography->id = $id;
				*/
				$users = [];
				$files = [];
				$otherUsers = [];
			}else{
				$users = $choreography->users;
				$files = $choreography->files;
				$otherUsers = ChoreographyController::getOtherUsers($users);
			}
			
			$choreographies = ChoreographyModel::all();
			
		}
		
		return View::make('pages.admin_choreography', array('choreography' => $choreography,
												   'choreographies' => $choreographies,
												   'users' => $users,
												   'files' => $files,
												   'otherUsers' => $otherUsers
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
		$choreography = ChoreographyModel::find($id);
		
		$validator = $this->validate(Input::except(['id']));
		if ($validator->passes()){
		
			$choreography->name = Input::get('name');
			$choreography->music = Input::get('music');
			
			$choreography->rhythm = Input::get('rhythm');
			$choreography->tempo = Input::get('tempo');
			
			$hours = Input::get('hours');
			$minutes = Input::get('minutes');
			$duration = $hours*60 + $minutes;
			
			$choreography->duration = $duration;
			
			$hard = Input::get('hard');
			$soft = Input::get('soft');
			
			$choreography->hard = (($hard == 'on')?1:0);
			$choreography->soft = (($soft == 'on')?1:0);
			$choreography->save();
			
			return Redirect::route('choreographies.show',$choreography->id)->withErrors($validator)->withInput();
		}else{
			$id = Input::get('id');
			return Redirect::route('choreographies.show',$id)->withErrors($validator)->withInput();
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
	
	
	// remove from other to knows
	public function addToKnows(){
		$choreography_id = Input::get('id');
		
		$choreography = ChoreographyModel::find($choreography_id);
		$choreography->users()->attach(Input::get('other'));
		
		return Redirect::route('choreographies.show', $choreography_id);
	}
	
	public function removeFromKnows(){
		$choreography_id = Input::get('id');
		
		$choreography = ChoreographyModel::find($choreography_id);
		$choreography->users()->detach(Input::get('know'));
		
		return Redirect::route('choreographies.show', $choreography_id);
	}
	

	public static function getOtherUsers($kUsers){
		$allUsers = UserModel::all();
		
		$otherUsers = array();
		
		foreach($allUsers as $user){
			if($user->isAdmin()){
				continue;
			}		
			
			$found = false;
			
			foreach($kUsers as $targetUser){
				
				//echo $targetUser->username . '</br>';
			
				if($user->id == $targetUser->id){
					$found = true;
					break;
				}
			}
			if(!$found){
				//echo $user->username . '</br>';
				array_push($otherUsers, $user);
			}
		}
		
		return $otherUsers;
	}

	private function getEmptyObject(){
		$choreography = new ChoreographyModel();
		$choreography->name = '';
		$choreography->music = '';
		$choreography->rhythm = '';
		$choreography->tempo = '';
		$choreography->duration = 0;
		$choreography->hard = '';
		$choreography->soft = '';
		
		$choreography->id = 0;
		return $choreography;
	}
}
