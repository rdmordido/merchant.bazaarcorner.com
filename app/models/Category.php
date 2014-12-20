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
						->whereRaw('is_active = 1')
						->orderBy('name','ASC')
						->get();
	}

	public function getMainCategories(){
		$main_categories = Category::selectRaw('id,name')
						->whereRaw('parent_id = 0 and is_active = 1')
						->orderBy('name','ASC')
						->get();
		if(count($main_categories) > 0){
			
			foreach($main_categories as $index=>$category):
				$main_categories[$index]['child_categories'] = $this->getSubCategories($category['id']);
			endforeach;

			return $main_categories;
		}else{
			return false;
		}
	}

	public function getSubCategories($id){
		return Category::selectRaw('id,name')
						->whereRaw('parent_id = ? and is_active = 1',array($id))
						->orderBy('name','ASC')
						->get();	
	}

	public function getCategoryDetails($id){
		return Category::find($id);	
	}
}
