<?php

class ConcertFileModel extends \Eloquent {
	protected $x;
	protected $guarded = ['*'];
	
	protected $table = 'concert_file';
	
	public $timestamps = false;
	
	public function concert()
	{
		return $this->belngsTo('ConcertModel', 'concert_id');
	}
	
}