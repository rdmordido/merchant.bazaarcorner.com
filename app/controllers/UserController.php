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

	/**
	 * Logout user account.
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
            $user_role 		= (isset($login_data['user_role']) && !empty($login_data['user_role'])) ? $login_data['user_role'] : 3;

            if (Auth::attempt(array('username' => $username, 'password' => $password),$remember_me)){
            	
            	$roles = Auth::user()->roles;
            	if($roles->contains($user_role)){
            		echo json_encode(array('success' => true));
            	}else{
            		$error_message = 'Invalid user group';
                	echo json_encode(array('success'=>false,'error_message'=>$error_message));	
            	}
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
