<?php

class ChoreographyFileModel extends \Eloquent {
	
	protected $fillable = [		
			'file_name', 'file_location', 'file_type', 'choreography_id'
	];
		
	protected $guarded = ['id'];
	
	protected $table = 'choreography_file';
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	public function choreography()
	{
		return $this->belngsTo('ChoreographyModel', 'choreography_id');
	}
	
	public function setFileNameAttribute($value)
	{
		$this->attributes['file_name'] = $value;
	}
	
	public function getFileNameAttribute($value)
	{
		if (empty($value))
			return null;
		else
		return $value;//Crypt::decrypt($value);
	}
	
	public function setFileLocationAttribute($value)
	{
		$this->attributes['file_location'] = $value;
	}
	
	public function getFileLocationAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return $value;//Crypt::decrypt($value);
	}
	
	public function setFileTypeAttribute($value)
	{
		$this->attributes['file_type'] = $value;
	}
	
	public function getFileTypeAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return $value;//Crypt::decrypt($value);
	}
	
	public function setChoreographyIdAttribute($value)
	{
		$this->attributes['choreography_id'] = $value;
	}
	
	public function getChoreographyIdAttribute($value)
	{
		if (empty($value))
			return null;
		else
			return $value;//Crypt::decrypt($value);
	}
	
	
}