<?php

class CompetitionModel extends \Eloquent {
	
	protected $fillable = [
			'name', 'date_start', 'date_end', 'judges', 'musician', 'location', 'solo'
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
		return $this->hasMany('CompetitionFileModel', 'competition_id');
	}
	
}