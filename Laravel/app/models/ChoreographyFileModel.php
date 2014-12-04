<?php

class ChoreographyFileModel extends \Eloquent {
	protected $x;
	protected $guarded = ['*'];
	
	protected $table = 'choreography_file';
	
	public $timestamps = false;
	
	public function choreography()
	{
		return $this->belngsTo('ChoreographyModel', 'choreography_id');
	}
	
}