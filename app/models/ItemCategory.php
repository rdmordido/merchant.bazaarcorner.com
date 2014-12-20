<?php

class ItemCategory extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 		= 'item_category';
	protected $fillable 	= array(
									 'item_id'
									,'category_id'
									,'is_primary'
								);
	protected $hidden 		= array(
									'created_at'
									,'updated_at'
								);

	static function getItemMainCategory($item_id){
		return DB::table('item_category')
		->select('category.id','category.name')
		->join('category','category.id','=','item_category.category_id')
		->where('item_category.item_id',$item_id)
		->where('item_category.is_primary',1)
		->first();
	}

	static function getItemSubCategory($item_id){
		return DB::table('item_category')
		->select('category.id','category.name')
		->join('category','category.id','=','item_category.category_id')
		->where('item_category.item_id',$item_id)
		->where('item_category.is_primary',0)
		->first();
	}
	
}
