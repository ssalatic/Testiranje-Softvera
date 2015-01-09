<?php

class ChoreographyModel extends \Eloquent {
	

	protected $fillable = [
			'name', 'music', 'rhythm', 'tempo', 'duration', 'hard', 'soft'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'choreography';
	
	public $timestamps = false;
	
	public function users()
	{
		return $this->belongsToMany('UserModel', 'user_choreography', 'choreography_id', 'user_id');
	}
	
	public function files()
	{
		return $this->hasMany('ChoreographyFileModel', 'choreography_id');
	}
	
	public function concertChoreography()
	{
		return $this->hasMany('ConcertChoreographyModel', 'choreography_id');
	}
	
	public static function getAll(){
		$choreographies = ChoreographyModel::all();
		return $choreographies;
	}
	
}