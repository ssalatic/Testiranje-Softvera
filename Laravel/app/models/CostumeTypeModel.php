<?php

class CostumeTypeModel extends \Eloquent {
	
	protected $fillable = [
			'name'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'costume_type';
	
	public $timestamps = false;
	
	public function costumes()
	{
		return $this->hasMany('CostumeModel', 'costume_type_id');
	}
	
}