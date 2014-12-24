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
	
	public function group()
	{
		return $this->belongsTo('GroupModel');
	}
	
	
	public static function getTrainings(){
		$trainings = TrainingModel::all();
		return $trainings;
	}
	
	
	public static function getVisibleTrainings(){
		$trainings = TrainingModel::all();
		
		$currentDate = new DateTime();
		$visibleTrainings = array();
		
		foreach($trainings as $training){
			$training_date = new DateTime($training->date);
			$interval = $currentDate->diff($training_date);
			
			$day = $interval->format('%d');
			$yar = $interval->format('%y');
			$mon = $interval->format('%m');
			if($yar == 0 && $mon == 0 && $day < 14)
				array_push($visibleTrainings,$training);
			
		}

		
		
		return $visibleTrainings;
	}
}