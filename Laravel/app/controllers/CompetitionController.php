<?php

class CompetitionController extends \BaseController {
	
	private $competition;
	
	public function __construct(CompetitionModel $comp)
	{
		$this->competition = $comp;
		
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

		$comp = CompetitionModel::first();

		if($comp == null){
			$comp = $this->getEmptyObject();
		}

		return Redirect::route('competitions.show', $comp->id);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.admin_competitions');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//$comp = Auth::user()->competitions()->first()->id;
		
		//$validator = $this->validate(Input::all());
		
		//if ($validator->passes())
		//{
			$cmp = new CompetitionModel();
			$cmp->name = Input::get('name');
			$cmp->date_start = Input::get('date_start');
			$cmp->date_end = Input::get('date_end');
			$cmp->location = Input::get('location');
			$cmp->judges = Input::get('judges');
			$cmp->musician = Input::get('musician');

			$cmp->save();

// 			$trn->date = Input::get('practice_date').' '.Input::get('time');
// 			$trn->trainer_id = Input::get('teacher');
// 			$trn->group_id = Input::get('group');
// 			$trn->changed_by = Auth::user()->id;
// 			$trn->save();
				
// 			$trn->users()->sync(Input::get('users'));
		
			return Redirect::route('competitions.show', $cmp->id);
		//}
		//else
		//{
		//	return Redirect::route('competitions.show', $comp)->withErrors($validator);
		//}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$src = Input::get('search');
		if (isset($src)) {
			$mdl = CompetitionModel::where('name', '=', $src)->first();
			if (isset($mdl))
				return Redirect::route('competitions.show', $mdl->id);
			else
				return Redirect::route('competitions.show', $id)->withErrors("Not found!");
		}
		
		$cm = CompetitionModel::find($id);
		$cms = CompetitionModel::all();
		
		if ($cm != null)
			$files = $cm->files;
		else
			$files = null;
		
		if ($cm != null)
			$part = $cm->participations;
		else 
			$part = null;

		//echo count($part);
		
		if (Auth::user()->isAdmin())
			return View::make('pages.admin_competitions', array('comp' => $cm,
																'comps' => $cms,
																'parts' => $part,
																'files' => $files
																));
		else
			return View::make('pages.competitions', array('comp' => $cm,
														  'comps' => $cms,
														  'parts' => $part,
														  'files' => $files
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
		$cmp = CompetitionModel::find($id);
		$cmp->name = Input::get('name');
		$cmp->date_start = Input::get('date_start');
		$cmp->date_end = Input::get('date_end');
		$cmp->location = Input::get('location');
		$cmp->judges = Input::get('judges');
		$cmp->musician = Input::get('musician');

		$cmp->save();

// 			$trn->date = Input::get('practice_date').' '.Input::get('time');
// 			$trn->trainer_id = Input::get('teacher');
// 			$trn->group_id = Input::get('group');
// 			$trn->changed_by = Auth::user()->id;
// 			$trn->save();

// 			$trn->users()->sync(Input::get('users'));

		return Redirect::route('competitions.show', $cmp->id);
	}
	
	public function upload($id)
	{
		$file = $_FILES['file'];
		
		if ($file['name'] != '') {
			move_uploaded_file($file["tmp_name"], public_path().'/files/'.$file['name']);
				
			$cfm = new CompetitionFileModel();
				
			$cfm->file_name = $file['name'];
			$cfm->competition_id = $id;
			$cfm->file_type = $file['type'];
			$cfm->save();
				
			return Redirect::route('competitions.show', $id);
		} else {
			return Redirect::route('competitions.show', $id)->withErrors('Error uploading file!');
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
		$cm = CompetitionModel::find($id);
		$cm->delete();

		return Redirect::route('competitions.index');
	}

	public function destroyFile($id)
	{
		$cfm = CompetitionFileModel::find($id);
		
		unlink(public_path().'/files/'.$cfm->file_name);
		$cfm->delete();
		
		return Redirect::route('competitions.index');
	}

	private function getEmptyObject(){
		$cmp = new ChoreographyModel();
		$cmp->name = '';
		$cmp->date_start = '';
		$cmp->date_end = '';
		$cmp->location = '';
		$cmp->judges = '';
		$cmp->musician = '';
		$cmp->id = 0;
		return $cmp;
	}


	public function add_new_user($id){

		$user = new ParticipationModel();
		$user->user_id = Input::get('user_id');
		$user->competition_id = $id;
		$user->result = Input::get('result');
		$star =  Input::get('star');
		if($star == 'on') $user->star = 1;
		else $user->star = 0;
		$user->competition_level_id = Input::get('level');
		$user->competition_type_id = Input::get('type');
		$user->save();

		return Redirect::route('competitions.show', $id);

	}

}
