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
}