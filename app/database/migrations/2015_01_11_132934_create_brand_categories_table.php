<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brand_categories',function($table){
			$table->integer('brand_id')->length(10)->unsigned();
			$table->string('category_id');
			$table->timestamps();
			$table->primary(array('brand_id','category_id'));
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('brand_categories');
	}

}
