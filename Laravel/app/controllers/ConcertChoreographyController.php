<?php

class ConcertChoreographyController extends \BaseController {

	private $concertChoreography;
	
	public function __construct(ConcertChoreographyModel $ccm)
	{
		$this->concertChoreography = $ccm;
	}

	
	public function validate($data)
	{
	
		$rules = array(
	
				'id' =>'somethimes|required|integer|unique:concert_choreography,id',
				'concert_id' => 'sometimes|required|integer|unique:concert,id',
				'choreography_id' => 'sometimes|required|integer|unique:choreography,id',
				'sequence_number' => 'sometimes|integer'
	
		);
	
		return Validator::make($data, $rules);
	
	}
	
	
	public function authorized()
	{
		if (Auth::user()->userType > 1)
			return false;
		
		return true;
	}
	
	
}
