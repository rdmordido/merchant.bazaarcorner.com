<?php

class UserController extends BaseController {

	public $user_model;

	public function __construct(){
		$this->user_model = new User();
	}

	/**
	 * Get user details.
	 *
	 * @return Response
	 */
	public function show($user_id)
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
		/*
		$request = Input::get();
		$user_data = array(
					'first_name' 				=> (isset($input['first_name'])) 				? $input['first_name'] 					: ''
					,'last_name' 				=> (isset($input['last_name'])) 				? $input['last_name'] 					: ''
					,'username' 				=> (isset($input['username'])) 					? $input['username'] 					: ''
					,'password' 				=> (isset($input['password'])) 					? $input['password'] 					: ''
					,'password_confirmation'	=> (isset($input['password_confirmation'])) 	? $input['password_confirmation'] 		: false
					,'email' 					=> (isset($input['email'])) 					? $input['email'] 						: ''
					,'birthday' 				=> (isset($input['birthday'])) 					? $input['birthday'] 					: ''
					,'phone' 					=> (isset($input['phone'])) 					? $input['phone'] 						: ''
					,'facebook' 				=> (isset($input['facebook'])) 					? $input['facebook'] 					: ''
					,'twitter' 					=> (isset($input['twitter'])) 					? $input['twitter'] 					: ''
					,'profile_image' 			=> (isset($input['profile_image'])) 			? $input['profile_image'] 				: ''
					,'cover_image' 				=> (isset($input['cover_image'])) 				? $input['cover_image'] 				: ''
					,'cover_text' 				=> (isset($input['cover_text'])) 				? $input['cover_text'] 					: ''
				);
		$validator = Validator::make(
			$user_data,
			array(
					 'username' 		=> 'required|unique:user'
					,'password' 		=> (isset($input['password_confirmation'])) ? 'required|confirmed' : 'required'
					,'first_name' 		=> 'required'
					,'last_name' 		=> 'required'
					,'email' 			=> 'required|email|unique:user'
					,'birthday' 		=> 'date'
					,'phone' 			=> ''
					,'facebook' 		=> ''
					,'twitter' 			=> ''
					,'profile_image' 	=> ''
					,'cover_image' 		=> ''
					,'cover_text' 		=> ''
			)
		);

		if($validator->passes()){
				$result = $this->user_model->createNewUser($user_data);
				if($result)
					return $this->returnData(array('success'=>true,'data'=>$result));
				else
					return $this->returnData(array('success'=>false,'error_message'=>'Something went wrong'));
		}else{
			$error_messages = implode('</br>',$validator->messages()->all());
			return $this->returnData(array('success'=>false,'error_message'=>$error_messages));
		}
		*/
	}

	public function profile()
	{
		return View::make('user_profile');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$data = Input::get();
		$user_data = array(
					'user_id' 				=> $id
					,'username' 			=> (isset($data['username'])) 				? $data['username'] 		: ''
					,'password' 			=> (isset($data['password'])) 				? $data['password'] 		: ''
					,'password_confirmation'=> (isset($data['password_confirmation']))  ? $data['password_confirmation'] : false
					,'first_name' 			=> (isset($data['first_name'])) 			? $data['first_name'] 		: ''
					,'last_name' 			=> (isset($data['last_name'])) 				? $data['last_name'] 		: ''
					,'birthdate' 			=> (isset($data['birthdate'])) 				? $data['birthdate'] 		: ''
					,'email' 				=> (isset($data['email'])) 					? $data['email'] 			: ''
					,'phone' 				=> (isset($data['phone'])) 					? $data['phone'] 			: ''
					,'profile_image' 		=> (isset($data['profile_image'])) 			? $data['profile_image'] 	: ''
			);
		$validator = Validator::make(
			$user_data,
			array(
					 'username' 			=> (isset($data['username']) && $data['username'] != $user->username) 					? 'required|unique:user' 	: 'required'
					,'password' 			=> (isset($data['password']) && $data['password'] != '') 								? 'required|confirmed' 		: ''
					,'password_confirmation'=> (isset($data['password']) && $data['password'] != '') 								? 'required' 				: ''
					,'email' 				=> (isset($data['email']) && $data['email'] != '' && $data['email'] != $user->email) 	? 'required|unique:user' 	: 'required'
			),
			array(
					 'username.required' 		=> 'Username is required'
					,'username.unique' 			=> 'Username is not available'
					,'password.required' 		=> 'Password is required'
					,'password.confirmed' 		=> 'Password does not match'
					,'password_confirmation.required' => 'Confirm new password'
					,'email.required' 			=> 'Email Address is required'
					,'email.unique' 			=> 'Email Address is not available'
			)
		);
		if($validator->passes()){
			
				$new_user_details 	= $this->user_model->edit($user_data);
				if($new_user_details){
					echo json_encode(array('success'=>true,'data'=>$new_user_details));
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

	public function update_profile_image(){
		$data 			= Input::get();
		$user_id 		= (isset($data['user_id']) && !empty($data['user_id'])) ? $data['user_id'] : false;
		$profile_image 	= (isset($data['profile_image']) && !empty($data['profile_image'])) ? $data['profile_image'] : null;
		if($user_id){
			$user = User::find($user_id);
			$user->profile_image = $profile_image;
			$user->save();
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Login user account.
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
            $role_id 		= (isset($login_data['role_id']) && !empty($login_data['role_id'])) ? $login_data['role_id'] : 3;

            if (Auth::attempt(array('username' => $username, 'password' => $password, 'role_id' => $role_id),$remember_me)){
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
	 * Logout user account.
	 *
	 * @return Response
	 */
	public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }
}
