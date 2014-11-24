<?php

class UserRole extends Eloquent{
	
	protected $table 		= 'user_role';
	protected $fillable 	= array('user_id','role_id');
	protected $hidden 		= array('created_at','updated_at');
 	
 
}