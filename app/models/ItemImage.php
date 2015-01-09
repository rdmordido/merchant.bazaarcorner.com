<?php

class ItemImage extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 		= 'item_images';
	protected $primaryKey 	= 'id';
	protected $guarded 		= array('id');
	protected $fillable 	= array(
									'item_id'
									,'name'
									,'is_primary'
								);
	protected $hidden 		= array(
									'created_at'
									,'updated_at'
								);

	static function getItemPrimaryImage($item_id){
		return DB::table('item_images')
		->select('name')
		->where('item_id',$item_id)
		->where('is_primary',1)
		->first();
	}
}
