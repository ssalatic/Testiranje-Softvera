<?php

class CompetitionLevelModel extends \Eloquent {
	
	protected $fillable = ['name'];
	
	protected $guarded = ['id'];
	
	protected $table = 'competition_level';
	
	public $timestamps = false;
	
	public function competitions()
	{
		return $this->belongsToMany('ParticipationModel', 'competition_level_id');
	}
	
}