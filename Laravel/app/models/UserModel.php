<?php

class UserModel extends \Eloquent {
	
	protected $fillable = [
			
			'first_name', 'last_name', 'birth_date', 'phone_number',
			'adress', 'height', 'shoe_size', 'ballet_shoe_size',
			'sneakers_size', 'changed_by'
			
	];
	
	protected $guarded = [
			
			'id', 'username', 'password', 'usertype', 'social_number',
			'created_at', 'changed_at', 'deleted_at',  'remember_token'
			
	];
	
	protected $table = 'user';
	
	protected $hidden = array('password');
	
	use SoftDeletingTrait;
	
	protected $dates = ['deleted_at'];
	
	public function setPasswordAtribute($value)
	{
		
	}
	
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
		return $this->belongToMany('CompetitonModel', 'competition_user', 'user_id', 'competition_id')->withPivot('result');
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
	
	public function setUsernameAttribute($value)
	{
		$this->attributes['username'] = Crypt::encrypt($value);
	}
	
	public function getUsernameAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Crypt::encrypt($value);
	}
	
	public function getPasswordAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setFirstNameAttribute($value)
	{
		$this->attributes['first_name'] = Crypt::encrypt($value);
	}
	
	public function getFirstNameAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setLastNameAttribute($value)
	{
		$this->attributes['last_name'] = Crypt::encrypt($value);
	}
	
	public function getLastNameAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setSocialNumberAttribute($value)
	{
		$this->attributes['social_number'] = Crypt::encrypt($value);
	}
	
	public function getSocialNumberAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setPhoneNumberAttribute($value)
	{
		$this->attributes['phone_number'] = Crypt::encrypt($value);
	}
	
	public function getPhoneNumberAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setAddressAttribute($value)
	{
		$this->attributes['address'] = Crypt::encrypt($value);
	}
	
	public function getAddressAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setHeightAttribute($value)
	{
		$this->attributes['height'] = Crypt::encrypt($value);
	}
	
	public function getHeightAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setBalletShoeSizeAttribute($value)
	{
		$this->attributes['ballet_shoe_size'] = Crypt::encrypt($value);
	}
	
	public function getBalletShoeSizeAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setSneakersSizeAttribute($value)
	{
		$this->attributes['sneakers_size'] = Crypt::encrypt($value);
	}
	
	public function getSneakersSizeAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = Crypt::encrypt($value);
	}
	
	public function getEmailAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
	public function setSexAttribute($value)
	{
		$this->attributes['sex'] = Crypt::encrypt($value);
	}
	
	public function getSexAttribute($value)
	{
		return Crypt::decrypt($value);
	}
	
}