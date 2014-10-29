<?php

class CostumeModel extends \Eloquent {
	
	protected $fillable = [];
	
	protected $table = 'costume';
	
	use SoftDeletingTrait;
	
	protected $dates = ['deleted_at'];
	
}