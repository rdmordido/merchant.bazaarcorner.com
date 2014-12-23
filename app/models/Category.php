<?php

class Category extends Eloquent{

	protected $table 		= 'category';
	protected $primaryKey 	= 'id';
	protected $hidden 		= array(
									'created_at'
									,'updated_at'
								);

	public function getCategories(){
		$category_list = Category::selectRaw('id,name')
						->where('is_active',1)
						->orderBy('name','ASC')
						->get();
	}

	public function getMainCategories(){
		return Category::MainCategory()->orderBy('name','ASC')->get();
	}

	public function getSubCategories($id){
		return Category::selectRaw('id,name')
						->where('parent_id',$id)
						->where('is_active',1)
						->orderBy('name','ASC')
						->get();
	}

	public function getCategoryDetails($id){
		return Category::find($id);	
	}

	public function scopeMainCategory($query){
		return $query->where('parent_id',0)->where('is_active',1);
	}
}
