<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;

class UserModel extends \Eloquent implements UserInterface {
	
	protected $fillable = [
			
			'first_name', 'last_name', 'birth_date', 'phone_number','gender',
			'adress', 'height', 'shoe_size', 'ballet_shoe_size',
			'sneakers_size', 'changed_by'
			
	];
	
	protected $guarded = [
			
			'id', 'username', 'password', 'usertype', 'social_number',
			'created_at', 'changed_at', 'deleted_at',  'remember_token', 'validated'
			
	];
	
	protected $table = 'user';
	
	protected $primaryKey = 'id';
	
	protected $hidden = array('password', 'id', 'remember_token');
	
	use SoftDeletingTrait;
	
	protected $dates = ['deleted_at'];
	
	public function concertChoreographyUser()
	{
		return $this->hasMany('ConcertChoreographyUserModel', 'user_id');
	}
	
	public function ownsCostumes()
	{
		return $this->hasMany('CostumeModel', 'owner');
	}
	
	public function hasCostumes()
	{
		$this->hasMany('CostumeModel', 'user_in_possesion');
	}
	
	public function choreographys()
	{
		return $this->belongsToMany('ChoreographyModel', 'user_choreography', 'user_id', 'choreography_id');
	}
	
	public function costumes(){
		return $this->hasMany('CostumeModel','owner');
	}
	
	public function trainerInTrainings()
	{
		return $this->hasMany('TrainingModel', 'trainer_id');
	}
	
	public function trainings()
	{
		return $this->belongsToMany('TrainingModel', 'user_training', 'user_id', 'training_id');
	}
	
	public function competitions()
	{
		return $this->belongsToMany('ParticipationModel', 'competition_user', 'user_id', 'participation_id')->withPivot('result');
	}
	
	public function payments()
	{
		return $this->hasMany('PaymentModel', 'user_id');
	}
	
	public function groups()
	{
		return $this->belongsToMany('GroupModel', 'user_group', 'user_id', 'group_id');
	}


	public function inGroup($id)
	{
		$groups = $this->groups()->getResults();
		foreach($groups as $group){
			if($group->id == $id){
				return true;
			}
		}
		return false;
	}
	
	public function defaultTrainerInGroups()
	{
		return $this->hasMany('GroupModel', 'default_trainer');
	}
	
	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = Crypt::encrypt($value);
	}
	
	public function getEmailAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function setFirstNameAttribute($value)
	{
		$this->attributes['first_name'] = Crypt::encrypt($value);
	}
	
	public function getFirstNameAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setLastNameAttribute($value)
	{
		$this->attributes['last_name'] = Crypt::encrypt($value);
	}
	
	public function getLastNameAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setSocialNumberAttribute($value)
	{
		$this->attributes['social_number'] = Crypt::encrypt($value);
	}
	
	public function getSocialNumberAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setPhoneNumberAttribute($value)
	{
		$this->attributes['phone_number'] = Crypt::encrypt($value);
	}
	
	public function getPhoneNumberAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setAddressAttribute($value)
	{
		$this->attributes['address'] = Crypt::encrypt($value);
	}
	
	public function getAddressAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setHeightAttribute($value)
	{
		$this->attributes['height'] = $value;//Crypt::encrypt($value);
	}
	
	public function getHeightAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return $value;//Crypt::decrypt($value);
	}
	
	public function setBalletShoeSizeAttribute($value)
	{
		$this->attributes['ballet_shoe_size'] = $value;//Crypt::encrypt($value);
	}
	
	public function getBalletShoeSizeAttribute($value)
	{
		if (empty($value))
			return null;
		else
		return $value;//Crypt::decrypt($value);
	}
	
	public function setSneakersSizeAttribute($value)
	{
		$this->attributes['sneakers_size'] = $value; //Crypt::encrypt($value);
	}
	
	public function getSneakersSizeAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return $value;//Crypt::decrypt($value);
	}
	
	public function setSexAttribute($value)
	{
		$this->attributes['sex'] = Crypt::encrypt($value);
	}
	
	public function getSexAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function getAuthIdentifier()
	{
		
		return $this->getKey();
	}
	
	public function getAuthPassword()
	{
		
		return $this->attributes['password'];
	}
	
	public function getRememberToken()
	{
		return $this->attributes['remember_token'];
	}
	
	public function setRememberToken($value)
	{
		$this->attributes['remember_token'] = $value;
	}
	
	public function getRememberTokenName()
	{
		return 'remember_token';
	}
	
	public function isAdmin(){
		return $this->attributes['user_type'] == 0 ||
		$this->attributes['user_type'] == 4 ||
		$this->attributes['user_type'] == 5 ||
		$this->attributes['user_type'] == 6 ||
		$this->attributes['user_type'] == 10 ||
		$this->attributes['user_type'] == 11 ||
		$this->attributes['user_type'] == 12 ||
		$this->attributes['user_type'] == 14;
	}
	
	public function isTrainer(){
		return $this->attributes['user_type'] == 1 ||
		$this->attributes['user_type'] == 4 ||
		$this->attributes['user_type'] == 7 ||
		$this->attributes['user_type'] == 8 ||
		$this->attributes['user_type'] == 10 ||
		$this->attributes['user_type'] == 11 ||
		$this->attributes['user_type'] == 13 ||
		$this->attributes['user_type'] == 14;
	}
	
	
	public function isDesigner(){
		return $this->attributes['user_type'] == 2 ||
		$this->attributes['user_type'] == 5 ||
		$this->attributes['user_type'] == 7 ||
		$this->attributes['user_type'] == 9 ||
		$this->attributes['user_type'] == 10 ||
		$this->attributes['user_type'] == 12 ||
		$this->attributes['user_type'] == 13 ||
		$this->attributes['user_type'] == 14;
	}
	
	public function isDancer(){
		return $this->attributes['user_type'] == 3 ||
		$this->attributes['user_type'] == 6 ||
		$this->attributes['user_type'] == 8 ||
		$this->attributes['user_type'] == 9 ||
		$this->attributes['user_type'] == 11 ||
		$this->attributes['user_type'] == 12 ||
		$this->attributes['user_type'] == 13 ||
		$this->attributes['user_type'] == 14;
	}
	
	public static function getUsers($userType){
		
		$users = UserModel::all(); //DB::table('user')->where('user_type', $userType)->get();
		
		echo '<select class="form-control" multiple="" onchange="location=this.options[this.selectedIndex].value" size = "3" >'; 
				
		foreach($users as $user){
			if($userType == 0)
				if($user->isAdmin())
					echo '<option value ="'.route('users.update',$user->id).'">'.$user->username.'</option>';
			if($userType == 1)
				if($user->isTrainer())
					echo '<option value ="'.route('users.update',$user->id).'">'.$user->username.'</option>';
			if($userType == 2)
				if($user->isDesigner())
					echo '<option value ="'.route('users.update',$user->id).'">'.$user->username.'</option>';
			if($userType == 3)
				if($user->isDancer())
					echo '<option value ="'.route('users.update',$user->id).'">'.$user->username.'</option>';
		} 
		
		echo '</select>';
	}
	
	public static function printUserType($id){
		if($id == 0) echo "Admin";
		if($id == 1) echo "Trainer";
		if($id == 2) echo "Designer";
		if($id == 3) echo "Dancer";
		if($id == 4) echo "Admin, Trainer";
		if($id == 5) echo "Admin, Designer";
		if($id == 6) echo "Admin, Dancer";
		if($id == 7) echo "Trainer, Designer";
		if($id == 8) echo "Trainer, Dancer";
		if($id == 9) echo "Designer, Dancer";
		if($id == 10) echo "Admin, Trainer, Designer";
		if($id == 11) echo "Admin, Trainer, Dancer";
		if($id == 12) echo "Admin, Designer, Dancer";
		if($id == 13) echo "Trainer, Designer, Dancer";
		if($id == 14) echo "Admin, Trainer, Designer, Dancer";
	}
	
	/*public static function getUserWithId($id){
		$user = DB::table('user')->where('id', $id)->first();
		return $user;
	}
	
	public static function getGroups($id){
		$groups = DB::table('user_group')->where('user_id',$id)->get();
		
		return $groups;
	}*/
}