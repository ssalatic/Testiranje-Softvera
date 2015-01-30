<?php

class CompetitionLevelModel extends \Eloquent {
	
	protected $fillable = ['name', 'age_cat'];
	
	protected $guarded = ['id'];
	
	protected $table = 'competition_level';
	
	public $timestamps = false;
	
	public function competitions()
	{
		return $this->hasMany('ParticipationModel');//, 'competition_level_id');
	}
	
}