<?php

class Item extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 		= 'items';
	protected $primaryKey 	= 'id';
	protected $guarded 		= array('id');
	protected $fillable 	= array('brand_id','merchant_id','sku','name','description','price');
	protected $appends   	= array('brand','main_category','sub_category','primary_image','images');

	public function getBrandAttribute(){
		return Brand::find($this->brand_id);
	}

	public function getMainCategoryAttribute(){
		return ItemCategory::where('item_id',$this->id)->where('is_primary',1)->first();
	}

	public function getSubCategoryAttribute(){
		return ItemCategory::where('item_id',$this->id)->where('is_primary',0)->first();
	}

	public function getPrimaryImageAttribute(){
		$image 		= ItemImage::where('item_id',$this->id)->where('is_primary',1)->first();
		$image 		= ($image) ? $image : new stdClass;		
		$urls 		= getUploadedImageUrl('item',(isset($image->name)) ? $image->name : '');
		
		foreach($urls as $key=>$url){
			$image->$key = $url;
		}
		
		return $image;
	}

	public function getImagesAttribute(){
		return ItemImage::where('item_id',$this->id)->get();
	}

	private function generateSKU(){
		return time(); //temporary sku format
	}

	public function store($item = array()){

		$new_item = new Item;
		$new_item->merchant_id 	= Auth::user()->merchant->id;
		$new_item->name 		= $item['name'];
		$new_item->price 		= $item['price'];
		$new_item->brand_id 	= (isset($item['brand_id']) && !empty($item['brand_id'])) 		? $item['brand_id'] 	: null;
		$new_item->description 	= (isset($item['description']) && !empty($item['description'])) ? $item['description'] 	: null;
		$new_item->sku 			= $this->generateSKU();

		if($new_item->save()){

			/*Save Item Categories*/
			$item_categories = array(
					new ItemCategory(array('category_id'=>$item['item_main_category'],'is_primary'=>1)),
					new ItemCategory(array('category_id'=>$item['item_sub_category'],'is_primary'=>0))
			);
			$new_item->item_categories()->saveMany($item_categories);

			/*Save Item Images*/
			$primary_image 			= $item['item_primary_image'];
			$uploaded_images 		= $item['item_images'];

			if(is_array($uploaded_images) && sizeof($uploaded_images) > 0){
				$item_images 			= array();
				foreach($uploaded_images as $image){
					$item_images[] = new ItemImage(array('name'=>$image,'is_primary'=>($image == $primary_image) ? 1 : 0));
				}
				$new_item->images()->saveMany($item_images);
			}

			return $item;
		}else{
			return false;
		}
		
	}

	public function edit($item_details = array()){
		$item_id = (isset($item_details['item_id']) && !empty($item_details['item_id'])) ? $item_details['item_id'] : false;
		if($item = Item::findOrFail($item_id)){
			$item->name 		= (isset($item_details['name']) && !empty($item_details['name'])) 					? $item_details['name'] 		: $item->name;
			$item->price 		= (isset($item_details['price']) && !empty($item_details['price'])) 				? $item_details['price'] 		: $item->price;
			$item->discount_id 	= (isset($item_details['discount_id']) && !empty($item_details['discount_id'])) 	? $item_details['discount_id'] 	: $item->discount_id;
			$item->brand_id 	= (isset($item_details['brand_id']) && !empty($item_details['brand_id'])) 			? $item_details['brand_id'] 	: $item->brand_id;
			$item->description 	= (isset($item_details['description']) && !empty($item_details['description'])) 	? $item_details['description'] 	: $item->description;
			
			ItemCategory::where('item_id', '=', $item_id)->delete();
			$item_categories = array(
					new ItemCategory(array('category_id'=>$item_details['item_main_category'],'is_primary'=>1)),
					new ItemCategory(array('category_id'=>$item_details['item_sub_category'],'is_primary'=>0))
			);
			$item->item_categories()->saveMany($item_categories);

			
			$primary_image 			= $item_details['item_primary_image'];
			$uploaded_images 		= $item_details['item_images'];

			if(is_array($uploaded_images) && sizeof($uploaded_images) > 0){
				ItemImage::where('item_id', '=', $item_id)->delete();
				$item_images 			= array();
				foreach($uploaded_images as $image){
					$item_images[] = new ItemImage(array('name'=>$image,'is_primary'=>($image == $primary_image) ? 1 : 0));
				}
				$item->images()->saveMany($item_images);
			}
			
			$item->save();

			return $item;
		}
	}

	public function getDetailsById($id){
		$item = Item::findOrFail($id);
		if($item){
			$item->primary_image 	= ItemImage::getItemPrimaryImage($id);
			return $item;
		}else{
			return false;
		}
	}

	public function getMerchantItemsList($merchant_id){

		$item_details = Item::with('brand','images')
						->where('merchant_id',$merchant_id)
						->orderBy('created_at','DESC')
						->get();
		foreach($item_details as $item){

			$item->main_category 	= ItemCategory::getItemMainCategory($item->id);
			$item->sub_category 	= ItemCategory::getItemSubCategory($item->id);
			$item->primary_image 	= ItemImage::getItemPrimaryImage($item->id);
		}
		return $item_details;
	}

	public function getItemListPrice(){

		switch ($this->discount->type) {
			case 'rate':
				return $this->price - ($this->price * ($this->discount->rate / 100));
				break;
			case 'price':
				return $this->price - $this->discount->price;
				break;
			default:
				return $this->price;
				break;
		}
	}

	public function getItemPrimaryImage(){
		return $this->images()->where('is_primary',1)->first();
	}

	public function getItemMainCategory(){
		return $this->categories()->where('is_primary',1)->first();
	}

	public function getItemSubCategory(){
		return $this->categories()->where('is_primary',0)->first();
	}

	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/
	public function brand(){
		return $this->hasOne('Brand','id','brand_id');
	}
	public function discount(){
		return $this->hasOne('Discount','id','discount_id');
	}
	public function item_categories(){
		return $this->hasMany('ItemCategory','item_id');
	}
	
	public function categories(){
		return $this->belongsToMany('Category','item_categories');
	}
	public function images(){
		return $this->hasMany('ItemImage','item_id');
	}
	/*====================================================================================================================================
	| QUERY SCOPES
	/*====================================================================================================================================*/
	public function scopePrimary($query){
		return $query->where('is_primary',1);
	}
	public function scopeActive($query){
		return $query->where('is_active',1);
	}
}
