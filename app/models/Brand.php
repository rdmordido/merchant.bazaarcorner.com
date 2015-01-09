<?php

class Brand extends Eloquent{

	protected $table 		= 'brands';
	protected $primaryKey 	= 'id';
	protected $hidden 		= array(
									'created_at'
									,'updated_at'
									,'is_active'
								);
	
	public function getBrandList(){
		return Brand::where('is_active',1)
					->orderBy('name','ASC')
					->get();
	}
}
