<?php

class Discount extends Eloquent{

	protected $table 		= 'discounts';
	protected $primaryKey 	= 'id';
	protected $hidden 		= array(
									'created_at'
									,'updated_at'									
								);
	public function getDetailsById($id){
		$discount = Discount::findOrFail($id);
		if($discount){
			return $discount;
		}else{
			return false;
		}
	}

	public function store($input = array()){

		$discount = new Discount;
		$discount->merchant_id 		= Auth::user()->merchant->id;
		$discount->title 			= $input['title'];
		$discount->description 		= $input['description'];
		$discount->start 			= $input['start'];
		$discount->end 				= $input['end'];
		$discount->type 			= $input['type'];
		$discount->rate 			= (isset($input['rate'])) 	? $input['rate'] 	: '';
		$discount->price 			= (isset($input['price'])) 	? $input['price'] 	: '';
		$discount->image 			= $input['image'];
		
		if($discount->save()){
			return $discount;
		}else{
			return false;
		}
	}

	public function edit($input = array()){
		$discount_id = (isset($input['discount_id']) && !empty($input['discount_id'])) ? $input['discount_id'] : false;
		if($discount = Discount::findOrFail($discount_id)){
			
			$discount->merchant_id 		= Auth::user()->merchant->id;
			$discount->title 			= (isset($input['title']) && $input['title'] != '') 			? $input['title'] 		: $discount->title;
			$discount->description 		= (isset($input['description']) && $input['description'] != '') ? $input['description'] : $discount->description;
			$discount->start 			= (isset($input['start']) && $input['start'] != '') 			? $input['start'] 		: $discount->start;
			$discount->end 				= (isset($input['end']) && $input['end'] != '') 				? $input['end'] 		: $discount->end;
			$discount->type 			= (isset($input['type']) && $input['type'] != '') 				? $input['type'] 		: $discount->type;
			$discount->rate 			= (isset($input['rate']) && $input['rate'] != '') 				? $input['rate'] 		: $discount->rate;
			$discount->price 			= (isset($input['price']) && $input['price'] != '') 			? $input['price'] 		: $discount->price;
			$discount->image 			= (isset($input['new_image']) && $input['new_image'] != '') 	? $input['new_image'] 	: $discount->image;
			
			if($discount->save()){
				return $discount;
			}else{
				return false;
			}
		}else
			return false;
	}

	public function getMerchantDiscountsList($merchant_id){
		return Discount::where('merchant_id',$merchant_id)
					->orderBy('created_at','DESC')
					->get();
	}

	public function getActiveMerchantDiscountList($merchant_id){
		return Discount::where('merchant_id',$merchant_id)
					->where('is_active',1)
					->orderBy('created_at','DESC')
					->get();
	}

	public function items(){
		return $this->hasMany('Item');
	}
}
