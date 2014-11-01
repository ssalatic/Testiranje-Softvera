<?php

class ConcertModel extends \Eloquent {
	
	protected $fillable = [
			'session_id', 'name', 'location', 'start_time', 'end_time'
	];
	
	protected $guarded = [
			'id', 'created_at', 'changed_at'
	];
	
	protected $table = 'concert';
	
	public function tickets()
	{
		return $this->hasMany('TicketModel', 'concert_id');
	}
	
	public function files()
	{
		return $this->hasMany('ConcertFileModel', 'concert_id');
	}
	
	public function concertChoreography()
	{
		return $this->hasMany('ConcertChoreographyModel', 'concert_id');
	}
	
}