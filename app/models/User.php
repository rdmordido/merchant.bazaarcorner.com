<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	/**
	 * Create a new user.
	 *
	 * @return object
	 */
	public function store($user_data)
	{
		$new_user = new User;
		$new_user->role_id 			= $user_data['role_id'];
		$new_user->first_name 		= (isset($user_data['first_name']) && !empty($user_data['first_name'])) 		? $user_data['first_name'] 	: null;
		$new_user->last_name 		= (isset($user_data['last_name']) && !empty($user_data['last_name'])) 			? $user_data['last_name'] 	: null;
		$new_user->username 		= $user_data['username'];
		$new_user->password 		= (Hash::needsRehash($user_data['password'])) ? Hash::make($user_data['password']) : $user_data['password'];
		$new_user->email 			= $user_data['email'];
		$new_user->birthdate 		= (isset($user_data['birthdate']) && !empty($user_data['birthdate'])) 			? $user_data['birthdate'] 		: null;
		$new_user->phone 			= (isset($user_data['phone']) && !empty($user_data['phone'])) 					? $user_data['phone'] 			: null;
		$new_user->facebook 		= (isset($user_data['facebook']) && !empty($user_data['facebook']))				? $user_data['facebook'] 		: null;
		$new_user->twitter 			= (isset($user_data['twitter']) && !empty($user_data['twitter'])) 				? $user_data['twitter'] 		: null;
		$new_user->profile_image 	= (isset($user_data['profile_image']) && !empty($user_data['profile_image'])) 	? $user_data['profile_image'] 	: null;
		$new_user->cover_image 		= (isset($user_data['cover_image']) && !empty($user_data['cover_image'])) 		? $user_data['cover_image'] 	: null;
		$new_user->cover_text 		= (isset($user_data['cover_text']) && !empty($user_data['cover_text']))			? $user_data['cover_text'] 		: null;
		if($new_user->save())
			return $new_user;
		else
			return false;
	}

	public function edit($user_data){
		$user 						= User::find($user_data['user_id']);
		$user->first_name 		= (isset($user_data['first_name']) && !empty($user_data['first_name'])) 		? $user_data['first_name'] 								: null;
		$user->last_name 		= (isset($user_data['last_name']) && !empty($user_data['last_name'])) 			? $user_data['last_name'] 								: null;
		$user->username 		= (isset($user_data['username']) && !empty($user_data['username'])) 			? $user_data['username'] 								: $user->username;
		$user->password 		= (isset($user_data['password']) && !empty($user_data['password'])) 			? Hash::make($user_data['password']) 					: $user->password;
		$user->email 			= (isset($user_data['email']) && !empty($user_data['email'])) 					? $user_data['email'] 									: $user->email;
		$user->birthdate 		= (isset($user_data['birthdate']) && !empty($user_data['birthdate'])) 			? date('Y-m-d',strtotime($user_data['birthdate'])) 		: null;
		$user->phone 			= (isset($user_data['phone']) && !empty($user_data['phone'])) 					? $user_data['phone'] 									: null;
		$user->profile_image 	= (isset($user_data['profile_image']) && !empty($user_data['profile_image']) && $user_data['profile_image'] != $user->profile_image) 	? $user_data['profile_image'] : null;
		if($user->save())
			return $user;
		else
			return false;
	}
	
	public function merchant(){
		return $this->hasOne('Merchant');
	}

	public function roles(){
		return $this->belongsToMany('Role','user_role');
	}
	public function user_roles(){
		return $this->hasMany('UserRole');
	}

}
