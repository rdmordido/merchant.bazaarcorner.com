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
	public function createNewUser($user_data)
	{
		$new_user = new User;
		$new_user->first_name 		= (isset($user_data['first_name']) && !empty($user_data['first_name'])) 	? $user_data['first_name'] 	: null;
		$new_user->last_name 		= (isset($user_data['last_name']) && !empty($user_data['last_name'])) 	? $user_data['last_name'] 	: null;
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
		$new_user->save();

		$user_roles 	= (isset($user_data['user_roles']) && !empty($user_data['user_roles'])) ? $user_data['user_roles'] : 3;
		$roles 			= array();

		if($new_user->id){
			if($user_roles && is_array($user_roles)){
				foreach($user_roles as $role){
					UserRole::Create(array('user_id'=>$new_user->id,'role_id'=>$user_roles));
				}
			}
			if($user_roles && is_array($user_roles) == false){
				UserRole::Create(array('user_id'=>$new_user->id,'role_id'=>$user_roles));
			}
		return $new_user;
		}else{
			return false;
		}
	}

	public function roles(){
		return $this->belongsToMany('Role','user_role');
	}
	public function user_roles(){
		return $this->hasMany('UserRole');
	}

}
