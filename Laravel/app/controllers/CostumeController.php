<?php

class CostumeController extends \BaseController {
	
	private $costume;
	
	public function __construct(CostumeModel $cost)
	{
		$this->costume = $cost;
		
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
				
				'id' =>'sometimes|required|integer|unique:costume,id',
				'identifier' => 'sometimes|required|alpha_num|max:45',
				'size' => 'sometimes|alpha_num:max:45',
				'user_in_possesion' => 'sometimes|integer|exists:user,id',
				'costume_type_id' => 'sometimes|integer|required|exists:costume_type,id',
				'owner' => 'sometimes|integer|exists:user,id|required',
				'costume_type.id' =>'somethimes|required|integer|unique:costume_type,id',
				'costume_type.name' => 'sometimes|alpha_num|max:45'
				
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
		//return View::make('pages.costumes');
		$costume = CostumeModel::first();
		if(count($costume) != 0)
			return Redirect::route('costumes.show', $costume->id);
		else
				return Redirect::route('emptyPage', 0);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//$costume = new CostumeModel();
		//echo Input::get('costume_type')." ".Input::get('id');
		//$costume->identifier = Input::get('costume_type');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$costume = CostumeModel::find($id);
		//echo $costume->identifier;
		$costumeType = $costume->type()->getResults();
		//echo $costumeType->name;
		$costumes = $costumeType->costumes()->getResults();
		return View::make('pages.costumes', array(	'costume' => $costume,
													'costumes' => $costumes,
													'costumeType' => $costumeType			
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
		$costume = CostumeModel::find($id);
		$costume->identifier = Input::get('name');
		$costume->owner = Input::get('possesion');
		$costume->size = Input::get('size');

		$costume->save();
		//echo Input::get('possesion');
		return Redirect::route('costumes.show', $costume->id);
	}


	public function add_costume_type(){
		$costume_type = new CostumeTypeModel();
		$costume_type->name = Input::get('costume_type');
		$costume_type->save();

		return Redirect::route('emptyPage', 0);


	}

	public function add_costume(){
		$costume = new CostumeModel();
		$costume->identifier = Input::get('costume_name');
		$costume->costume_type_id = Input::get('id');
		$costume->owner = '2';
		$costume->size = 'XL';
		$costume->save();

		return Redirect::route('costumes.show', $costume->id);


	}
	
	
	
	/**
	 * God the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function emptyPage($id){
	
		if($id != 0)
			$costumeType = CostumeTypeModel::find($id);
		else 
			$costumeType = [];
		$costume = [];
		$costumes = [];
		return View::make('pages.costumes', array(	'costume' => $costume,
													'costumes' => $costumes,
													'costumeType' => $costumeType			
												));
	
	
	
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
