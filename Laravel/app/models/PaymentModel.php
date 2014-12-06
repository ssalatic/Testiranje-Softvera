<?php

class PaymentModel extends \Eloquent {
	
	protected $fillable = [
			'user_id', 'date_payed', 'amount', 'comment'
	];
	
	protected $guarded = [
			'id'
	];
	
	protected $table = 'payment';
	
	public $timestamps = false;
	
	public function user()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}
	
}