<?php

class ParticipationModel extends \Eloquent {
	
	protected $fillable = [
			'rythm', 'result', 'star'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'participation';
	
	public $timestamps = false;
	
	public function users()
	{
		return $this->belongsToMany('UserModel', 'competition_user', 'participation_id', 'user_id')->withPivot('result');
	}
	
	public function competition()
	{
		return $this->belongsTo('CompetitionModel', 'competition_id');
	}
	
	public function competitionLevel()
	{
		return $this->belongsTo('CompetitionLevelModel');//, 'competiton_levle_id');
	}
	
	public function competitionType()
	{
		return $this->belongsTo('CompetitionTypeModel');//, 'competiton_type_id');
	}
	
}