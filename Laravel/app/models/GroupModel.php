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

	public static function getGroups(){
	
		$groups = GroupModel::all(); //DB::table('user')->where('user_type', $userType)->get();
		
		echo '<select name="groups[]" class="form-control" id="group" multiple size = "3">';		

		foreach($groups as $group){
			echo '<option value="'.$group->id.'">'.$group->name.'</option>';
		} 
		
		echo '</select>';
	}
	
}