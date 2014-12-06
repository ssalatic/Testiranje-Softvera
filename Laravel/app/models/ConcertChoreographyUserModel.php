<?php

class ConcertChoreographyUserModel extends \Eloquent {
	
	protected $fillable = [
			'concert_choreography_id', 'user_id', 'costume_id'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'concert_choreography_user';
	
	public $timestamps = false;
	
	public function concertChoreography()
	{
		return $this->belongsTo('ConcertChoreographyModel', 'concert_choreography_id');
	}
	
	public function costume()
	{
		return $this->belongsTo('CostumeModel', 'costume_id');
	}
	
	public function user()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}
	
}