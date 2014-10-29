<?php

class UserModel extends \Eloquent {
	
	protected $fillable = [];
	
	protected $table = 'user';
	
	use SoftDeletingTrait;
	
	protected $dates = ['deleted_at'];
	
}