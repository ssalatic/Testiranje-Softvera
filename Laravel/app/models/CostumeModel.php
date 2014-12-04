<?php

class CostumeModel extends \Eloquent {
	protected $x;
	protected $fillable = [
			'identifier', 'size', 'user_in_posesion', 'costume_type_id', 'owner'
	];
	
	protected $guarded = [
			'id', 'created_at', 'changed_at', 'deleted_at'
	];
	
	protected $table = 'costume';
	
	use SoftDeletingTrait;
	
	protected $dates = ['deleted_at'];
	
	public function type()
	{
		return $this->belongsTo('CostumeTypeModel', 'costume_type_id');
	}
	
	public function userInPossesion()
	{
		return $this->belongsTo('UserModel', 'user_in_possesion');
	}
	
	public function owner()
	{
		return $this->belongsTo('UserModel', 'owner');
	}
	
	public function concertChoreographyUser()
	{
		return $this->hasMany('ConcertChoreographyUserModel', 'costume_id');
	}
	
}