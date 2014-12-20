<?php
class MerchantController extends BaseController {
	
	public function dashboard()
	{
		return View::make('dashboard');
	}

	public function showMerchantLogin(){
		if(Auth::check()){
			return Redirect::to('/');
		}else{
			return View::make('login');	
		}
	}

	public function showMerchantCreate(){
		return View::make('merchant_registration');
	}

	public function create(){
		$data = Input::get();
		$merchant_data = array(
					 'name' 				=> (isset($data['merchant_name'])) 			? $data['merchant_name'] 	: ''
					,'username' 			=> (isset($data['username'])) 				? $data['username'] 		: ''
					,'password' 			=> (isset($data['password'])) 				? $data['password'] 		: ''
					,'password_confirmation'=> (isset($data['password_confirmation']))  ? $data['password_confirmation'] : false
					,'email' 				=> (isset($data['email'])) 					? $data['email'] 	: ''
			);
		$validator = Validator::make(
			$merchant_data,
			array(
					 'name' 				=> 'required|unique:merchant'
					,'username' 			=> 'required|unique:user'
					,'password' 			=> (isset($data['password_confirmation'])) ? 'required|confirmed' : 'required'
					,'password_confirmation'=> 'required'
					,'email' 				=> 'required|unique:user'
			),
			array(
					 'name.required' 			=> 'Merchant name is required'
					,'name.unique' 				=> 'Merchant name is not available'
					,'username.required' 		=> 'Username is required'
					,'username.unique' 			=> 'Username is not available'
					,'password.required' 		=> 'Password is required'
					,'password.confirmed' 		=> 'Password does not match'
					,'password_confirmation.required' => 'Re-enter password'
					,'email.required' 			=> 'Email Address is required'
					,'email.unique' 			=> 'Email Address is not available'
			)
		);
		if($validator->passes()){
			
				$newMerchant 	= $this->merchant_model->store($merchant_data);
				if($newMerchant){
					echo json_encode(array('success'=>true,'data'=>$newMerchant));
				}else{
					echo json_encode(array('success'=>false,'error_message'=>'Something went wrong'));
				}
			
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'merchant_name' 		=> ($messages->has('name')) 			? $messages->first('name') 				: false
				,'username' 			=> ($messages->has('username')) 		? $messages->first('username') 			: false
				,'password' 			=> ($messages->has('password')) 		? $messages->first('password') 			: false
				,'password_confirmation' => ($messages->has('password_confirmation')) 		? $messages->first('password_confirmation') 			: false
				,'email' 				=> ($messages->has('email')) 			? $messages->first('email') 			: false
			);
			echo json_encode(array('success'=>false,'error_message'=>$error_messages));
		}
	}
}