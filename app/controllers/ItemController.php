<?php

class ItemController extends \BaseController {

	

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
		$this->data['items'] = Auth::user()->items()->get();
		return View::make('item.index',$this->data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data['discount_list'] 	= $this->discount_model->getActiveMerchantDiscountList(Auth::user()->id);
		$this->data['brand_list'] 		= $this->brand_model->getBrandList();
		$this->data['main_categories'] 	= $this->category_model->getMainCategories();
		return View::make('item.create',$this->data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::get();
		$item_data = array(
					 'name' 				=> (isset($data['item_name'])) 				? $data['item_name'] 			: ''
					,'description' 			=> (isset($data['item_description'])) 		? $data['item_description'] 	: ''
					,'price' 				=> (isset($data['item_price'])) 			? $data['item_price'] 			: ''
					,'brand_id' 			=> (isset($data['item_brand'])) 			? $data['item_brand'] 			: ''
					,'item_main_category' 	=> (isset($data['item_main_category'])) 	? $data['item_main_category'] 	: ''
					,'item_sub_category' 	=> (isset($data['item_sub_category'])) 		? $data['item_sub_category'] 	: ''
					,'item_primary_image' 	=> (isset($data['item_primary_image'])) 	? $data['item_primary_image'] 	: ''
					,'item_images' 			=> (isset($data['item_images'])) 			? $data['item_images'] 			: ''
			);
		$validator = Validator::make(
			$item_data,
			array(
					 'name' 				=> 'required'
					//,'description' 			=> 'required'
					,'price' 				=> 'required'
					//,'brand_id' 			=> 'required'
					,'item_main_category' 	=> 'required'
					,'item_sub_category' 	=> 'required'
					//,'item_primary_image' 	=> 'required'
			),
			array(
					 'name.required' 				=> 'Item name is required'
					,'description.required' 		=> 'Description is required'
					,'price.required' 				=> 'Price is required'
					,'brand_id.required' 			=> 'Brand name is required'
					,'item_main_category.required' 	=> 'Main Category is required'
					,'item_sub_category.required' 	=> 'Sub Category is required'
					,'item_primary_image.required' 	=> 'Primary Image is required'
			)
		);
		if($validator->passes()){
				$newItem 	= $this->item_model->store($item_data);
				if($newItem){
					echo json_encode(array('success'=>true,'data'=>$newItem));
				}else{
					echo json_encode(array('success'=>false,'error_message'=>'Something went wrong'));
				}
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'name' 				=> ($messages->has('name')) 				? $messages->first('name') 					: false
				,'description' 			=> ($messages->has('description')) 			? $messages->first('description') 			: false
				,'price' 				=> ($messages->has('price')) 				? $messages->first('price') 				: false
				,'brand_id' 			=> ($messages->has('brand_id')) 			? $messages->first('brand_id') 				: false
				,'item_main_category' 	=> ($messages->has('item_main_category')) 	? $messages->first('item_main_category') 	: false
				,'item_sub_category' 	=> ($messages->has('item_sub_category')) 	? $messages->first('item_sub_category') 	: false
				,'item_primary_image' 	=> ($messages->has('item_primary_image')) 	? $messages->first('item_primary_image') 	: false
				
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
		$item_details = $this->item_model->getDetailsById($id);
		return Response::view('modal_item_details',array('item'=>$item_details));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item_details 					= $this->item_model->getDetailsById($id);
		$this->data['item'] 			= $item_details;
		$this->data['brand_list'] 		= $this->brand_model->getBrandList();
		$this->data['discount_list'] 	= $this->discount_model->getActiveMerchantDiscountList(Auth::user()->id);
		$this->data['main_categories'] 	= $this->category_model->getMainCategories();
		$this->data['sub_categories'] 	= $this->category_model->getSubCategories($item_details->main_category->id);
		return View::make('item_update',$this->data);
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
		$item_data = array(
					 'item_id' 				=> (isset($data['item_id'])) 				? $data['item_id'] 				: ''
					,'merchant_id' 			=> (isset($data['merchant_id'])) 			? $data['merchant_id'] 			: ''
					,'name' 				=> (isset($data['item_name'])) 				? $data['item_name'] 			: ''
					,'description' 			=> (isset($data['item_description'])) 		? $data['item_description'] 	: ''
					,'price' 				=> (isset($data['item_price'])) 			? $data['item_price'] 			: ''
					,'discount_id' 			=> (isset($data['item_discount'])) 			? $data['item_discount'] 		: ''
					,'brand_id' 			=> (isset($data['item_brand'])) 			? $data['item_brand'] 			: ''
					,'item_main_category' 	=> (isset($data['item_main_category'])) 	? $data['item_main_category'] 	: ''
					,'item_sub_category' 	=> (isset($data['item_sub_category'])) 		? $data['item_sub_category'] 	: ''
					,'item_primary_image' 	=> (isset($data['item_primary_image'])) 	? $data['item_primary_image'] 	: ''
					,'item_images' 			=> (isset($data['item_images'])) 			? $data['item_images'] 			: ''
			);
		$validator = Validator::make(
			$item_data,
			array(
					 'item_id' 				=> 'required'
					,'merchant_id' 			=> 'required'
					,'name' 				=> 'required'
					//,'description' 			=> 'required'
					,'price' 				=> 'required'
					//,'brand_id' 			=> 'required'
					,'item_main_category' 	=> 'required'
					,'item_sub_category' 	=> 'required'
					//,'item_primary_image' 	=> 'required'
			),
			array(
					 'item_id.required' 			=> 'Item Id is required'
					,'merchant_id.required' 		=> 'Merchant Id is required'
					,'name.required' 				=> 'Item name is required'
					,'description.required' 		=> 'Description is required'
					,'price.required' 				=> 'Price is required'
					,'brand_id.required' 			=> 'Brand name is required'
					,'item_main_category.required' 	=> 'Main Category is required'
					,'item_sub_category.required' 	=> 'Sub Category is required'
					,'item_primary_image.required' 	=> 'Primary Image is required'
			)
		);
		if($validator->passes()){
				$item 	= $this->item_model->edit($item_data);
				if($item){
					echo json_encode(array('success'=>true,'data'=>$item));
				}else{
					echo json_encode(array('success'=>false,'error_message'=>'Something went wrong'));
				}
		}else{
			$messages = $validator->messages();
			$error_messages = array(
				 'merchant_id' 			=> ($messages->has('merchant_id')) 			? $messages->first('merchant_id') 			: false
				,'name' 				=> ($messages->has('name')) 				? $messages->first('name') 					: false
				,'description' 			=> ($messages->has('description')) 			? $messages->first('description') 			: false
				,'price' 				=> ($messages->has('price')) 				? $messages->first('price') 				: false
				,'brand_id' 			=> ($messages->has('brand_id')) 			? $messages->first('brand_id') 				: false
				,'item_main_category' 	=> ($messages->has('item_main_category')) 	? $messages->first('item_main_category') 	: false
				,'item_sub_category' 	=> ($messages->has('item_sub_category')) 	? $messages->first('item_sub_category') 	: false
				,'item_primary_image' 	=> ($messages->has('item_primary_image')) 	? $messages->first('item_primary_image') 	: false
				
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
		//
	}
}
