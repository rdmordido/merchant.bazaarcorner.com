<?php

class BaseController extends Controller {

	public $data = array();
	protected $merchant;
	protected $item_model;
	protected $brand_model;
	protected $category_model;
	
	public function __construct(){		
		$this->merchant 		= (Auth::check()) ? Merchant::find(Auth::user()->id) : false;
		$this->data['merchant'] = $this->merchant;
		$this->item_model 		= new Item();
		$this->brand_model 		= new Brand();
		$this->category_model 	= new Category();
		$this->discount_model 	= new Discount();
		$this->merchant_model 	= new Merchant();
		$this->order_model 		= new Order();
		$this->payment_model 	= new Payment();
		$this->follower_model 	= new Follower();
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
