<?php

class ItemCategory extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 		= 'item_categories';
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
		return DB::table('item_categories')
		->select('categories.id','categories.name')
		->join('categories','categories.id','=','item_categories.category_id')
		->where('item_categories.item_id',$item_id)
		->where('item_categories.is_primary',1)
		->first();
	}

	static function getItemSubCategory($item_id){
		return DB::table('item_categories')
		->select('categories.id','categories.name')
		->join('categories','categories.id','=','item_categories.category_id')
		->where('item_categories.item_id',$item_id)
		->where('item_categories.is_primary',0)
		->first();
	}
	
}
