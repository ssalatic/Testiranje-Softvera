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
		$this->attributes['height'] = Crypt::encrypt($value);
	}
	
	public function getHeightAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setBalletShoeSizeAttribute($value)
	{
		$this->attributes['ballet_shoe_size'] = Crypt::encrypt($value);
	}
	
	public function getBalletShoeSizeAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
	}
	
	public function setSneakersSizeAttribute($value)
	{
		$this->attributes['sneakers_size'] = Crypt::encrypt($value);
	}
	
	public function getSneakersSizeAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return Crypt::decrypt($value);
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
		return $this->attributes['user_type'] == 0;
	}
	
	public function isTrainer(){
		return $this->attributes['user_type'] == 1;
	}
	
	
	public function isDesigner(){
		return $this->attributes['user_type'] == 2;
	}
	
	public function isDancer(){
		return $this->attributes['user_type'] == 3;
	}
	
	public static function getUsers($userType){
		
		$users = UserModel::where('user_type', '=', $userType)->get(); //DB::table('user')->where('user_type', $userType)->get();
		
		echo '<select class="form-control" multiple="" onChange="alertselected(this)">'; 
					
		foreach($users as $user){
			echo '<option id="'.$user->id.'">'.$user->username.'</option>';
		} 
		
		echo '</select>';
	}
	
	public static function getUserWithId($id){
		$user = DB::table('user')->where('id', $id)->first();
		return $user;
	}
	
	public static function getGroups($id){
		$groups = DB::table('user_group')->where('user_id',$id)->get();
		
		return $groups;
	}
}