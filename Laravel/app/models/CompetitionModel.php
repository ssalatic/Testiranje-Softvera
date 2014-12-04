<?php

class CompetitionModel extends \Eloquent {
	protected $x;
	protected $fillable = [
			'name', 'date', 'judges', 'musician', 'location', 'solo'
	];
	
	protected $guarded = [
			'id', 'competition_type_id', 'competition_level_id'
	];
	
	protected $table = 'competition';
	
	public $timestamps = false;
	
	public function users()
	{
		return $this->belongsToMany('UserModel', 'competiton_user', 'competition_id', 'user_id')->withPivot('result');
	}
	
}