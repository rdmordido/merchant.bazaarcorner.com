<?php

class Merchant extends Eloquent{

	protected $table 		= 'merchants';
	protected $primaryKey 	= 'id';
	protected $hidden 		= array(
									'created_at'
									,'updated_at'
									,'is_active'
								);
	
	public function store($data){
		$user 		= new User();
		$user_data 	= array(
			 'role_id' 		=> 2
			,'username' 	=> $data['username']
			,'password' 	=> $data['password']
			,'email' 		=> $data['email']
		);
		$new_user = $user->store($user_data);
		if($new_user){
			$new_merchant 			= new Merchant();
			$new_merchant->name 	= $data['name'];
			$new_merchant->user_id 	= $new_user->id;
			if($new_merchant->save())
				return $new_merchant;
			else
				return false;
		}else{
			return false;
		}
		
	}
	
	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/

	public function user(){
		return $this->belongsTo('User');
	}

	public function orders(){
		return $this->hasMany('Order');
	}

}
