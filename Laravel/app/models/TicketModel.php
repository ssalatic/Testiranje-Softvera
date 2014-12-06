<?php

class TicketModel extends \Eloquent {
	
	protected $fillable = [
			'type', 'price', 'total', 'sold', 'concert_id'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'ticket';
	
	public $timestamps = false;
	
	public function concert()
	{
		return $this->belngsTo('ConcertModel', 'concert_id');
	}
	
}