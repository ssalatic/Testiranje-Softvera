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
	echo "kurac";/*
		$costumeType = CostumeTypeModel::find($id);
		$costume = [];
		$costumes = [];
		return View::make('pages.costumes', array(	'costume' => $costume,
													'costumes' => $costumes,
													'costumeType' => $costumeType			
												)); */
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
