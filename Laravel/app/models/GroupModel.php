<?php

class GroupModel extends \Eloquent {
	
	protected $fillable = [
			'name', 'default_trainer_id'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'group';
	
	public $timestamps = false;
	
	public function trainer()
	{
		return $this->belongsTo('UserModel', 'default_trainer_id');
	}
	
	public function users()
	{
		return $this->belongsToMany('UserModel', 'user_group', 'group_id', 'user_id');
	}
	
	public function trainings()
	{
		return $this->hasMany('TrainingModel', 'group_id');
	} 
	
}