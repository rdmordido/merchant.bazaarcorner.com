<?php
class MerchantController extends BaseController {

	public function index(){		
		/*show only for bazaarcorner user -- temporary*/
		if(Auth::user()->id != 1){return Redirect::to('/');}

		$this->data['merchants'] = Merchant::all();
		return View::make('merchant_list',$this->data);
	}
	
	public function dashboard()
	{
		return View::make('dashboard');
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
					 'name' 				=> 'required|unique:merchants'
					,'username' 			=> 'required|unique:users'
					,'password' 			=> (isset($data['password_confirmation'])) ? 'required|confirmed' : 'required'
					,'password_confirmation'=> 'required'
					,'email' 				=> 'required|unique:users'
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

	public function update($id){
		$merchant 			= Merchant::find($id);
		$merchant_data 		= Input::get();

		$validator = Validator::make(
			$merchant_data,
			array(
					 'name' 				=> (isset($merchant_data['name']) && $merchant_data['name'] != $merchant->name) 						? 'required|unique:merchants' 	: 'required'
					,'username' 			=> (isset($merchant_data['username']) && $merchant_data['username'] != $merchant->username) 			? 'required|unique:merchants' 	: 'required'
					,'password' 			=> (isset($merchant_data['password']) && $merchant_data['password'] != '') 								? 'required|confirmed' 			: ''
					,'password_confirmation'=> (isset($merchant_data['password']) && $merchant_data['password'] != '') 								? 'required' 					: ''
					//,'email' 				=> (isset($merchant_data['email']) && $merchant_data['email'] != '' && $merchant_data['email'] != $merchant->email) 	? 'required|unique:merchants' 	: 'required'
			),
			array(
					 'username.required' 		=> 'Username is required'
					,'username.unique' 			=> 'Username is not available'
					,'password.required' 		=> 'Password is required'
					,'password.confirmed' 		=> 'Password does not match'
					,'password_confirmation.required' => 'Confirm new password'
					//,'email.required' 		=> 'Email Address is required'
					//,'email.unique' 			=> 'Email Address is not available'
			)
		);


		if($validator->passes()){
			
				$merchant->name 			= (isset($merchant_data['name']) && !empty($merchant_data['name'])) 					? $merchant_data['name'] 									: $merchant->name;
				$merchant->username 		= (isset($merchant_data['username']) && !empty($merchant_data['username'])) 			? $merchant_data['username'] 								: $merchant->username;
				$merchant->password 		= (isset($merchant_data['password']) && !empty($merchant_data['password'])) 			? Hash::make($merchant_data['password']) 					: $merchant->password;
				$merchant->address 			= (isset($merchant_data['address']) && !empty($merchant_data['address'])) 				? $merchant_data['address'] 								: $merchant->address;		
				$merchant->website 			= (isset($merchant_data['website']) && !empty($merchant_data['website'])) 				? $merchant_data['website'] 								: $merchant->website;		
				$merchant->email 			= (isset($merchant_data['email']) && !empty($merchant_data['email'])) 					? $merchant_data['email'] 									: $merchant->email;		
				$merchant->phone 			= (isset($merchant_data['phone']) && !empty($merchant_data['phone'])) 					? $merchant_data['phone'] 									: $merchant->phone;
				$merchant->facebook 		= (isset($merchant_data['facebook']) && !empty($merchant_data['facebook'])) 			? $merchant_data['facebook']								: $merchant->facebook;
				$merchant->twitter 			= (isset($merchant_data['twitter']) && !empty($merchant_data['twitter'])) 				? $merchant_data['twitter']									: $merchant->twitter;

				if($merchant->save()){
					return Response::json(array('success'=>true,'data'=>$merchant));
				}else{
					return Response::json(array('success'=>false,'error_message'=>'Something went wrong'));
				}
			
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'name' 				=> ($messages->has('name')) 			? $messages->first('name') 				: false
				,'username' 			=> ($messages->has('username')) 		? $messages->first('username') 			: false
				,'password' 			=> ($messages->has('password')) 		? $messages->first('password') 			: false
				,'password_confirmation' => ($messages->has('password_confirmation')) 		? $messages->first('password_confirmation') 			: false
				,'email' 				=> ($messages->has('email')) 			? $messages->first('email') 			: false
			);
			echo json_encode(array('success'=>false,'error_message'=>$error_messages));
		}
	}

	/**
	 * Show merchant profile page
	 *
	 * @return Response
	 */

	public function profile()
	{
		return View::make('merchant_profile');
	}

	/**
	 * Show merchant login page
	 *
	 * @return Response
	 */
	public function showMerchantLogin(){
		if(Auth::check()){
			return Redirect::to('/');
		}else{
			return View::make('login');	
		}
	}

	/**
	 * Show merchant registration page
	 *
	 * @return Response
	 */
	public function showMerchantCreate(){
		return View::make('merchant_registration');
	}

	/**
	 * Login merchant account.
	 *
	 * @return Response
	 */
	public function login(){
		
		$login_data = Input::get();
        $validator 	= Validator::make($login_data,array('username' => 'required','password' => 'required'));

        if($validator->passes()){
            
            $username 		= $login_data['username'];
            $password 		= $login_data['password'];
            $remember_me 	= (isset($login_data['remember_me'])) ? true : false;            

            if (Auth::attempt(array('username' => $username, 'password' => $password),$remember_me)){
            	echo json_encode(array('success' => true));
            }else{
                $error_message = 'Incorrect username or password';
                echo json_encode(array('success'=>false,'error_message'=>$error_message));
            }
        }else{
            $error_message = 'Username and password are required';
            echo json_encode(array('success'=>false,'error_message'=>$error_message));
        }
        
	}

	/**
	 * Logout merchant account.
	 *
	 * @return Response
	 */
	public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }
}