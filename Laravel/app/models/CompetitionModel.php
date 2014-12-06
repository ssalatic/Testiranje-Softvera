<?php

class CompetitionModel extends \Eloquent {
	
	protected $fillable = [
			'name', 'date', 'judges', 'musician', 'location', 'solo'
	];
	
	protected $guarded = [
			'id', 'competition_type_id', 'competition_level_id'
	];
	
	protected $table = 'competition';
	
	public $timestamps = false;
	
	public function participations()
	{
		return $this->hasMany('ParticipationModel', 'competition_id');
	}
	
	public function files()
	{
		return $this->hasMany('Competition_file', 'competitioin_id');
	}
	
}