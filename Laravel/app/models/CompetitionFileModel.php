<?php

class CompetitionFileModel extends \Eloquent {
	
	protected $guarded = ['*'];
	
	protected $table = 'competition_file';
	
	public $timestamps = false;
	
	public function competition()
	{
		return $this->belongsTo('CompetitionModel', 'competition_id');
	}
	
}