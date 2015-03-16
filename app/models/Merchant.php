<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Merchant extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table 		= 'merchants';
	protected $primaryKey 	= 'id';
	protected $hidden 		= array(
									 'password'
									,'remember_token'
									,'created_at'
									,'updated_at'
									,'is_active'
								);	

	public function store($data){

		$merchant 				= new Merchant();
		$merchant->name 		= $data['name'];
		$merchant->username 	= $data['username'];
		$merchant->password 	= Hash::make($data['password']);
		$merchant->email 		= $data['email'];
		$merchant->address 		= (isset($data['address']) && !empty($data['address'])) 	? $data['address'] 	: null;
		$merchant->website 		= (isset($data['website']) && !empty($data['website'])) 	? $data['website'] 	: null;
		$merchant->phone 		= (isset($data['phone']) && !empty($data['phone'])) 		? $data['phone'] 	: null;
		$merchant->facebook 	= (isset($data['facebook']) && !empty($data['facebook'])) 	? $data['facebook'] : null;
		$merchant->twitter 		= (isset($data['twitter']) && !empty($data['twitter'])) 	? $data['twitter'] 	: null;

		if($merchant->save()){
			return $merchant;
		}else{
			return false;
		}
		
	}

	public function edit($merchant_data){
		$merchant 					= Merchant::find($merchant_data['merchant_id']);
		$merchant->name 			= (isset($merchant_data['name']) && !empty($merchant_data['name'])) 					? $merchant_data['name'] 									: $merchant->name;
		$merchant->username 		= (isset($merchant_data['username']) && !empty($merchant_data['username'])) 			? $merchant_data['username'] 								: $merchant->username;
		$merchant->password 		= (isset($merchant_data['password']) && !empty($merchant_data['password'])) 			? Hash::make($merchant_data['password']) 					: $merchant->password;
		$merchant->address 			= (isset($merchant_data['address']) && !empty($merchant_data['address'])) 				? $merchant_data['address'] 								: $merchant->address;		
		$merchant->website 			= (isset($merchant_data['website']) && !empty($merchant_data['website'])) 				? $merchant_data['website'] 								: $merchant->website;		
		$merchant->email 			= (isset($merchant_data['email']) && !empty($merchant_data['email'])) 					? $merchant_data['email'] 									: $merchant->email;		
		$merchant->phone 			= (isset($merchant_data['phone']) && !empty($merchant_data['phone'])) 					? $merchant_data['phone'] 									: $merchant->phone;
		$merchant->facebook 		= (isset($merchant_data['facebook']) && !empty($merchant_data['facebook'])) 			? $merchant_data['facebook'] 								: $merchant->facebook;
		
		if($merchant->save())
			return $merchant;
		else
			return false;
	}
	
	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/

	public function user(){
		return $this->belongsTo('User');
	}

	public function items(){
		return $this->hasMany('Item');
	}

	public function discounts(){
		return $this->hasMany('Discount');
	}

	public function orders(){
		return $this->hasMany('Order');
	}

}

