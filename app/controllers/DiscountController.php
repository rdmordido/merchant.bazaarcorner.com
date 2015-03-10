<?php

class DiscountController extends \BaseController {


	public function __construct(){
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['discount_list'] = $this->discount_model->getMerchantDiscountsList(Auth::user()->id);		
		return View::make('discount.index',$this->data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('discount.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::get();
		$discount_data = array(
					 'title' 			=> (isset($data['discount_title'])) 		? $data['discount_title'] 			: ''
					,'type' 			=> (isset($data['discount_type'])) 			? $data['discount_type'] 			: ''
					,'price' 			=> (isset($data['discount_price'])) 		? $data['discount_price'] 			: ''
					,'rate' 			=> (isset($data['discount_rate'])) 			? $data['discount_rate'] 			: ''
					,'date' 			=> (isset($data['discount_date'])) 			? $data['discount_date'] 		: ''
					,'start' 			=> (isset($data['discount_start'])) 		? $data['discount_start'] 			: ''
					,'end' 				=> (isset($data['discount_end'])) 			? $data['discount_end'] 			: ''
					,'description' 		=> (isset($data['discount_description'])) 	? $data['discount_description'] 	: ''
					,'image' 			=> (isset($data['discount_image'])) 		? $data['discount_image'] 			: ''
			);
		$validator = Validator::make(
			$discount_data,
			array(
					 'title' 				=> 'required'
					,'type' 				=> 'required'
					,'price' 				=> (isset($data['discount_type']) && $data['discount_type'] == 'price') ? 'required' : ''
					,'rate' 				=> (isset($data['discount_type']) && $data['discount_type'] == 'rate') 	? 'required' : ''
					,'date' 				=> 'required'					
					//,'image' 				=> 'required'
			),
			array(
					 'title.required' 			=> 'Discount title is required'
					,'type.required' 			=> 'Discount type is required'
					,'price.required' 			=> 'Discount price is required'
					,'rate.required' 			=> 'Discount rate is required'
					,'date.required' 			=> 'Discount date range is required'
					,'image.required' 			=> 'Discount image is required'
			)
		);
		if($validator->passes()){
				$newDiscount 	= $this->discount_model->store($discount_data);
				if($newDiscount){
					echo json_encode(array('success'=>true,'data'=>$newDiscount));
				}else{
					echo json_encode(array('success'=>false,'error_message'=>'Something went wrong'));
				}
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'title' 		=> ($messages->has('title')) 		? $messages->first('title') 		: false
				,'type' 		=> ($messages->has('type')) 		? $messages->first('type') 			: false
				,'price' 		=> ($messages->has('price')) 		? $messages->first('price') 		: false
				,'rate' 		=> ($messages->has('rate')) 		? $messages->first('rate') 			: false
				,'date' 		=> ($messages->has('date')) 		? $messages->first('date') 			: false								
				,'image' 		=> ($messages->has('image')) 		? $messages->first('image') 		: false
				
			);
			echo json_encode(array('success'=>false,'error_message'=>$error_messages));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$discount_details = $this->discount_model->getDetailsById($id);
		return Response::view('modal.discount',array('discount'=>$discount_details));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$discount_details = $this->discount_model->getDetailsById($id);
		return View::make('discount.edit',array('discount'=>$discount_details));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::get();
		$discount_data = array(
					'discount_id' 		=> $id
					,'title' 			=> (isset($data['discount_title'])) 		? $data['discount_title'] 			: ''
					,'type' 			=> (isset($data['discount_type'])) 			? $data['discount_type'] 			: ''
					,'price' 			=> (isset($data['discount_price'])) 		? $data['discount_price'] 			: ''
					,'rate' 			=> (isset($data['discount_rate'])) 			? $data['discount_rate'] 			: ''
					,'date' 			=> (isset($data['discount_date'])) 			? $data['discount_date'] 			: ''
					,'start' 			=> (isset($data['discount_start'])) 		? $data['discount_start'] 			: ''
					,'end' 				=> (isset($data['discount_end'])) 			? $data['discount_end'] 			: ''
					,'description' 		=> (isset($data['discount_description'])) 	? $data['discount_description'] 	: ''
					,'image' 			=> (isset($data['discount_image'])) 		? $data['discount_image'] 			: ''
					,'new_image' 		=> (isset($data['discount_image_new']) && $data['discount_image_new'] != '') 	? $data['discount_image_new'] 		: ''
			);
		$validator = Validator::make(
			$discount_data,
			array(
					 'title' 				=> 'required'
					,'type' 				=> 'required'
					,'price' 				=> (isset($data['discount_type']) && $data['discount_type'] == 'price') ? 'required' : ''
					,'rate' 				=> (isset($data['discount_type']) && $data['discount_type'] == 'rate') 	? 'required' : ''
					,'date' 				=> 'required'					
					//,'image' 				=> 'required'
			),
			array(
					 'title.required' 			=> 'Discount title is required'
					,'type.required' 			=> 'Discount type is required'
					,'price.required' 			=> 'Discount price is required'
					,'rate.required' 			=> 'Discount rate is required'
					,'date.required' 			=> 'Discount date range is required'
					,'image.required' 			=> 'Discount image is required'
			)
		);
		if($validator->passes()){
				$discount 	= $this->discount_model->edit($discount_data);
				if($discount){
					$discount->old_image = ($discount_data['image'] != $discount->image) 	? $discount_data['image'] : false;
					echo json_encode(array('success'=>true,'data'=>$discount));
				}else{
					echo json_encode(array('success'=>false,'error_message'=>'Something went wrong'));
				}
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'title' 		=> ($messages->has('title')) 		? $messages->first('title') 		: false
				,'type' 		=> ($messages->has('type')) 		? $messages->first('type') 			: false
				,'price' 		=> ($messages->has('price')) 		? $messages->first('price') 		: false
				,'rate' 		=> ($messages->has('rate')) 		? $messages->first('rate') 			: false
				,'date' 		=> ($messages->has('date')) 		? $messages->first('date') 			: false								
				,'image' 		=> ($messages->has('image')) 		? $messages->first('image') 		: false
				
			);
			echo json_encode(array('success'=>false,'error_message'=>$error_messages));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Discount::destroy($id))
			return Response::json(array('success'=>true));
		else
			return Response::json(array('success'=>false));
	}

	public function items($id){
		$this->data['discount'] = Discount::find($id);
		return View::make('discount.items',$this->data);
	}


}
