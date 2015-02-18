<?php

class Follower extends Eloquent{

	protected $table 		= 'followers';
	protected $primaryKey 	= array('follower_id','user_id');
	
	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/
	public function users(){
        return $this->belongsTo('User','id','user_id');
    }
}
