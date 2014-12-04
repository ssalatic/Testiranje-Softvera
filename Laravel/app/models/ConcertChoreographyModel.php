<?php

class ConcertChoreographyModel extends \Eloquent {
	protected $x;
	protected $fillable = [
			'concert_id', 'choreography_id', 'sequence_number'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'concert_choreography';
	
	public $timestamps = false;
	
	public function concert()
	{
		return $this->belongsTo('ConcertModel', 'concert_id');
	}
	
	public function choreography()
	{
		return $this->belongsTo('ChoreographyModel', 'choreography_id');
	}
	
	public function concertChoreographyUser()
	{
		return $this->hasMany('ConcertChoreographyUserModel', 'concert_choreography_id');
	}
	
}