<?php

class TrainingModel extends \Eloquent {
	
	protected $fillable = [
			'group_id', 'date', 'trainer_id', 'finished', 'changed_by'
	];
	
	protected $guarded = [
			'id', 'created_at', 'changed_at'
	];
	
	protected $table = 'training';
	
	public function trainer()
	{
		return $this->belongsTo('UserModel', 'trainer_id');
	}
	
	public function users()
	{
		return $this->belongsToMany('UserModel', 'user_training', 'training_id', 'user_id');
	}
	
	public function trainers()
	{
		return $this->belongsToMany('UserModel', 'trainer_training', 'training_id', 'user_id');
	}
	
	public function group()
	{
		return $this->belongsTo('GroupModel');
	}
	
	public static function getTrainings(){
		$trainings = TrainingModel::all();
		return $trainings;
	}
}