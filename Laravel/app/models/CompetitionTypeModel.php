<?php

class CompetitionTypeModel extends \Eloquent {
	protected $x;
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
		return $this->hasMany('CompetitonModel', 'competition_type_id');
	}
	
}