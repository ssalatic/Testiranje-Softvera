<?php

class CompetitionTypeModel extends \Eloquent {
	
	protected $fillable = [
			'name', 'solo'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'competition_type';
	
	public $timestamps = false;
	
	public function competitions()
	{
		return $this->belongsToMany('ParticipationModel', 'competition_type_id');
	}
	
}