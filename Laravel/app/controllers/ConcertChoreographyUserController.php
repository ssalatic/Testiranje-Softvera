<?php

class ConcertChoreographyUserController extends \BaseController {

	private $concertChoreographyUser;
	
	public function __construct(ConcertChoreographyUserModel $ccm)
	{
		$this->concertChoreographyUser = $ccm;
	}
	
	
	public function validate($data)
	{
	
		$rules = array(
	
				'id' =>'sometimes|required|integer|unique:concert_choreography_user,id',
				'concert_choreography_id' => 'sometimes|required|integer|unique:concert_choreography,id',
				'user_id' => 'sometimes|required|integer|unique:user,id',
				'costume_id' => 'sometimes|integer|unique:costume,id'
	
		);
	
		return Validator::make($data, $rules);
	
	}
	
	
	public function authorized()
	{
		if (Auth::user()->userType >= 10)
			return false;
		
		return true;
	}
	

}
